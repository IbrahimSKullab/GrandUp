<?php

namespace App\Services\Order;

use PDF;
use Exception;
use App\Models\Order;
use App\Helper\Helper;
use App\Models\Seller;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Exports\ExportOrder;
use App\Models\DeliveryRates;
use App\Models\SellerProduct;
use App\Models\ShippingCompany;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\Seller\NewOrderNotification;
use App\Notifications\Shipping\NewOrderCompnyNotification;

class UserOrderServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Order::query()->where('user_id', Auth::id())->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Order::query()->where('user_id', Auth::id())->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $products = self::handleRequest($request);
            $total_price_order = 0;

            foreach ($products as $product) {
                foreach ($product as $pro) {
                    $total_price_order = +$pro['price'];
                }
            }

            foreach ($products as $seller_id => $product) {
                $seller = Seller::query()->find($seller_id);
                $user = Auth::user();

                $delivery_fee = 0;

                if ($request->is_delivery == true) {
                    $shipping_company = ShippingCompany::first();

                    if (is_null($shipping_company)) {
                        throw new Exception(__('Shipping Company Not Found Remove Shipping Order'));
                    }

                    if (! empty($user->governorate_id) && ! empty($seller->governorate_id)) {
                        if ($user->governorate_id == $seller->governorate_id) {
                            $delivery_rate = DeliveryRates::where('country_id', $user->country_id)->where('type', 'governorate')->first();
                            $delivery_fee = $delivery_rate->price;
                        } else {
                            $delivery_rate = DeliveryRates::where('country_id', $user->country_id)->where('type', 'country_governorate')->first();
                            $delivery_fee = $delivery_rate->price;
                        }
                    }

                    if ($delivery_fee > $shipping_company->current_points) {
                        throw new Exception(__('Shipping Not Access Order'));
                    }

                    $shipping_company_point = $shipping_company->current_points - $delivery_fee;
                    $shipping_company->update([
                        'current_points' => $shipping_company_point,
                    ]);
                    $shipping_company_id = $shipping_company->id;
                }

                $totalCost = collect($product)->sum(function ($p) use ($delivery_fee) {
                    if ($p['price']) {
                        return ($p['price'] * $p['qty']) + $delivery_fee;
                    }

                    return 0;
                });

                $totalQty = collect($product)->sum('qty');

                $points = collect($product)->sum(function ($p) {
                    if ($p['points']) {
                        return $p['points'] * $p['qty'];
                    }

                    return 0;
                });

                if ($seller->current_points > $points) {
                    $GainedPoints = $points;
                } else {
                    $GainedPoints = $seller->current_points ?? 0;
                }

                $order = Order::query()->create([
                    'seller_id' => $seller_id,
                    'user_id' => Auth::id(),
                    'shipping_company_id' => $shipping_company_id ?? null,
                    'total_cost' => $totalCost,
                    'delivery_fee' => $delivery_fee,
                    'total_cost_currency' => $seller->default_currency,
                    'total_qty' => $totalQty,
                    'points' => $GainedPoints,
                ]);

                $order->update([
                    'code' => $seller->seller_code . '000' . $order->id,
                ]);

                if (! empty($order->shipping_company_id)) {
                    $order->shippingCompany->notify(new NewOrderCompnyNotification($order));
                }

                foreach ($product as $item) {
                    OrderItem::query()->create([
                        'order_id' => $order->id,
                        'seller_id' => $seller_id,
                        'user_id' => Auth::id(),
                        'seller_product_id' => $item['id'],
                        'product_price' => $item['price'],
                        'product_price_currency' => $seller->default_currency,
                        'is_ordinary_price' => Auth::user()->isOrdinaryFriendToSeller($seller_id),
                        'is_special_price' => Auth::user()->isSpecialFriendToSeller($seller_id),
                        'qty' => $item['qty'],
                    ]);
                }

                if ($seller->current_points > $points) {
                    $seller->update([
                        'current_points' => $seller->current_points - $points,
                    ]);
                } else {
                    $seller->update([
                        'current_points' => 0,
                    ]);
                }

                $order->refresh();

//                $product->increment('popularity');

                $seller->notify(new NewOrderNotification($order));

                $pdfFile = $this->downloadPdf($order->id);

                $excelFile = $this->downloadExcel($order->id);

                Log::info($pdfFile);
                Log::info($excelFile);

                // Todo => Change whatsapp
                Helper::sendFileMessageToWhatsapp('9647502120570', $pdfFile, __('Order From') . ' ' . $order->user->name);
                sleep(1);
                Helper::sendFileMessageToWhatsapp('9647502120570', $excelFile, __('Excelsheet for order from') . ' ' . $order->user->name);
            }
        });
    }

    private static function handleRequest($request): array
    {
        $products = [];
        foreach ($request->products as $reqProduct) {
            $product = SellerProduct::query()->find($reqProduct['id']);

            $seller = Seller::query()->find($product->seller_id);

            $price = $product->price;
            //Check the string and decreases quantity for the stock
            if (isset($reqProduct['variation'])) {
                $count = count(json_decode($product->variation));
                for ($i = 0; $i < $count; $i++) {
                    if (json_decode($product->variation)[$i]->type == $reqProduct['variation']) {
                        if ($reqProduct['qty'] > json_decode($product->variation)[$i]->qty) {
                            return $products;
                        }

                        $price_var = json_decode($product->variation)[$i]->price;

                        if (Auth::user()->isOrdinaryFriendToSeller($seller->id)) {
                            $price = $product->price + $price_var;
                        } else {
                            $price = $product->price + $price_var;
                        }

                        if (Auth::user()->isSpecialFriendToSeller($seller->id)) {
                            $price = $product->special_price + $price_var ?? $product->price + $price_var;
                        } else {
                            $price = $product->price + $price_var;
                        }
                    }
                }
            } else {
                if (Auth::user()->isOrdinaryFriendToSeller($seller->id)) {
                    $price = $product->price;
                } else {
                    $price = $product->price;
                }

                if (Auth::user()->isSpecialFriendToSeller($seller->id)) {
                    $price = $product->special_price ?? $product->price;
                } else {
                    $price = $product->price;
                }
            }
            if (isset($reqProduct['variation'])) {
                $products[$seller->id][] = [
                    'id' => $product->id,
                    'qty' => $reqProduct['qty'],
                    'price' => $price,
                    'points' => $product->points ?? 0,
                    'variation' => $reqProduct['variation'],
                ];
            } else {
                $products[$seller->id][] = [
                    'id' => $product->id,
                    'qty' => $reqProduct['qty'],
                    'price' => $price,
                    'points' => $product->points ?? 0,
                ];
            }
        }

        return $products;
    }

    public function downloadPdf($id): string
    {
        $order = Order::query()->find($id);
        $pdf = PDF::loadView('order.pdf', ['order' => $order]);
        $filename = Str::uuid() . '.pdf';
        $pdf->save(public_path('invoices/' . $filename));

        return asset('invoices/' . $filename);
    }

    public function downloadExcel($id): string
    {
        $order = Order::query()->find($id);
        $filename = Str::uuid()->toString();
        Excel::store(new ExportOrder($order), $filename . '.xlsx', 'excel');

        return asset('invoices/' . $filename . '.xlsx');
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function checkVariation($request)
    {
        $product_exist = [];
        foreach ($request->products as $product_value) {
            $product = SellerProduct::findOrFail($product_value['id']);

            $str = '';
            $variations = [];

            //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
            $choices = [];
            foreach (json_decode($product->choice_options) as $key => $choice) {
                $choices[$choice->name] = $product_value[$choice->name];
                $variations[$choice->title] = $product_value[$choice->name];
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $product_value[$choice->name]);
                } else {
                    $str .= str_replace(' ', '', $product_value[$choice->name]);
                }
            }

            $product->choices = json_encode($choices);
            //chek if out of stock
            if (($product['current_stock'] < $product_value['quantity'])) {
                return [
                    'status' => 0,
                    'message' => __('quantity_not_found!'),
                ];
            }

            $product['variations'] = json_encode($variations);

            $product['variant'] = $str;

            //Check the string and decreases quantity for the stock
            if ($str != null) {
                $count = count(json_decode($product->variation));
                for ($i = 0; $i < $count; $i++) {
                    if (json_decode($product->variation)[$i]->type == $str) {
                        array_push($product_exist, $product->id);
                        $price = json_decode($product->variation)[$i]->price;
                        if (json_decode($product->variation)[$i]->qty < $product_value['quantity']) {
                            return [
                                'status' => 0,
                                'message' => __('variation_quantity_not_found!'),
                                'product_id' => $product->id,
                            ];
                        }
                    }
                }
            }
//            else {
//                return [
//                    'status' => 1,
//                    'message' => __('exist_product!'),
//                ];
//            }
        }
        foreach ($request->products as $product) {
            $value = !in_array($product['id'], $product_exist);

            if ($value) {
                return [
                    'status' => 0,
                    'message' => __('quantity_not_found!'),
                    'product_id' => $product['id'],
                ];
            }
        }
    }

    public function getPoints($request): array
    {
        $products = self::handleRequest($request);

        $result = [];

        foreach ($products as $seller => $product) {
            $seller = Seller::query()->find($seller);

            $sellerPoints = $seller->current_points;

            $points = collect($product)->sum(function ($p) {
                if ($p['points']) {
                    return $p['points'] * $p['qty'];
                }

                return 0;
            });

            $result[] = [
                'seller_name' => $seller->name,
                'is_seller_has_enough_points' => $sellerPoints >= $points && $sellerPoints != 0,
            ];
        }

        return $result;
    }
}
