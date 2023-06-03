<?php

namespace App\Services\Order;

use App\Notifications\Shipping\NewOrderCompnyNotification;
use PDF;
use Exception;
use App\Models\Order;
use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\OrderEnum;
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
use App\Notifications\User\OrderAcceptedNotification;
use App\Notifications\User\OrderCanceledNotification;
use App\Notifications\Seller\GeneralNewOrderNotification;
use App\Notifications\Shipping\ReadyOrderOnDeliveryNotification;

class SellerOrderServices implements ServiceInterface
{
    public function get(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('seller_id', $seller->id)->latest()->get();
    }

    public function GetBuyIndex(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('user_seller_id', $seller->id)->latest()->get();
    }

    public function getBuyShow($id, $checkStatus = false): Model
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('user_seller_id', $seller->id)->findOrFail($id);
    }

    public function getLatest(): Model|null
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }
        $order = Order::where('seller_id', $seller->id)->latest()->first();

        return $order;
    }

    public function store($request)
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $user_seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $user_seller = auth()->user();
        }

        return DB::transaction(function () use ($request, $user_seller) {
            $products = self::handleRequest($request);
            $total_price_order = 0;

            foreach ($products as $product) {
                foreach ($product as $pro) {
                    $total_price_order = +$pro['price'];
                }
            }
            foreach ($products as $seller_id => $product) {
                $seller = Seller::query()->find($seller_id);

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

                $totalCost = collect($product)->sum(function ($p) {
                    if (isset($p['price'])) {
                        return $p['price'] * $p['qty'];
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
                    'user_seller_id' => $user_seller->id,
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

                if (!empty($order->shipping_company_id)) {
                    $order->shippingCompany->notify(new NewOrderCompnyNotification($order));
                }

                foreach ($product as $item) {
                    OrderItem::query()->create([
                        'order_id' => $order->id,
                        'seller_id' => $seller_id,
                        'user_seller_id' => $user_seller->id,
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

                foreach ($products as $product2) {
                    foreach ($product2 as $pro) {
                        $product_ = SellerProduct::findOrFail($pro['id']);
                        $product_->update([
                            'current_stock' => $product_->current_stock - $pro['qty'],
                        ]);
                        if (isset($pro['variation'])) {
                            $count = count(json_decode($product_->variation));
                            $array1 = json_decode($product_->variation);
                            for ($i = 0; $i < $count; $i++) {
//                                dd(json_decode($product_->variation)[$i]->type, $pro['variation']);
                                if (json_decode($product_->variation)[$i]->type === $pro['variation']) {
                                    $update_variation = [
                                        'type' => json_decode($product_->variation)[$i]->type,
                                        'price' => json_decode($product_->variation)[$i]->price,
                                        'sku' => json_decode($product_->variation)[$i]->sku,
                                        'qty' => json_decode($product_->variation)[$i]->qty - $pro['qty'],
                                    ];

                                    unset($array1[$i]);
                                    $array2 = array_values($array1);
                                    array_push($array2, $update_variation);
                                    $array3 = array_values($array2);
                                    $product_->update([
                                        'variation' => json_encode($array3),
                                    ]);
                                }
                            }
                        }
                    }
                }

                $seller->notify(new GeneralNewOrderNotification($order));

                $pdfFile = $this->downloadPdf($order->id);

                $excelFile = $this->downloadExcel($order->id);

                Log::info($pdfFile);
                Log::info($excelFile);

                // Todo => Change whatsapp
                Helper::sendFileMessageToWhatsapp('9647502120570', $pdfFile, __('Order From') . ' ' . $order->userSeller->name);
                sleep(1);
                Helper::sendFileMessageToWhatsapp('9647502120570', $excelFile, __('Excelsheet for order from') . ' ' . $order->userSeller->name);
            }
        });
    }

    private static function handleRequest($request): array
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $products = [];
        foreach ($request->products as $reqProduct) {
            $product = SellerProduct::query()->find($reqProduct['id']);

            $store_seller = Seller::query()->find($product->seller_id);

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

                        if ($seller->isOrdinaryFriendToSeller($store_seller->id)) {
                            $price = $product->price + $price_var;
                        } else {
                            $price = $product->price + $price_var;
                        }

                        if ($seller->isSpecialFriendToSeller($store_seller->id)) {
                            $price = $product->special_price + $price_var ?? $product->price + $price_var;
                        } else {
                            $price = $product->price + $price_var;
                        }
                    }
                }
            } else {
                if ($seller->isOrdinaryFriendToSeller($store_seller->id)) {
                    $price = $product->price;
                } else {
                    $price = $product->price;
                }

                if ($seller->isSpecialFriendToSeller($store_seller->id)) {
                    $price = $product->special_price ?? $product->price;
                } else {
                    $price = $product->price;
                }
            }
            $products[$store_seller->id][] = [
                'id' => $product->id,
                'qty' => $reqProduct['qty'],
                'price' => $price,
                'points' => $product->points ?? 0,
                'variation' => $reqProduct['variation'],
            ];
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

    public function checkVariation($request)
    {
        $product = SellerProduct::findOrFail($request->id);

        $str = '';
        $variations = [];

        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        $choices = [];
        foreach (json_decode($product->choice_options) as $key => $choice) {
            $choices[$choice->name] = $request[$choice->name];
            $variations[$choice->title] = $request[$choice->name];
            if ($str != null) {
                $str .= '-' . str_replace(' ', '', $request[$choice->name]);
            } else {
                $str .= str_replace(' ', '', $request[$choice->name]);
            }
        }

        $product->choices = json_encode($choices);
        //chek if out of stock
        if (($product['current_stock'] < $request['quantity'])) {
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
                    $price = json_decode($product->variation)[$i]->price;
                    if (json_decode($product->variation)[$i]->qty < $request['quantity']) {
                        return [
                            'status' => 0,
                            'message' => __('variation_quantity_not_found!'),
                        ];
                    }

                    return [
                        'status' => 1,
                        'message' => __('exist_product!'),
                    ];
                }
            }

            return [
                'status' => 0,
                'message' => __('not_exist_product!'),
            ];
        } else {
            return [
                'status' => 1,
                'message' => __('exist_product!'),
            ];
        }
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function exportPDF($id, $is_streaming = false)
    {
        $order = $this->findById($id);
        $pdf = PDF::loadView('order.pdf', ['order' => $order]);
        if ($is_streaming) {
            return $pdf->stream($order->code . '.pdf');
        } else {
            $filename = Str::uuid() . '.pdf';
            $pdf->save(public_path('invoices/' . $filename));

            return asset('invoices/' . $filename);
        }
    }

    public function findById($id, $checkStatus = false): Model
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('seller_id', $seller->id)->findOrFail($id);
    }

    public function exportExcelSheet($id)
    {
        $order = $this->findById($id);

        return Excel::download(new ExportOrder($order), $order->code . '.xlsx');
    }

    public function updateStatus($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {
            $order = $this->findById($id);

            $orderCurrentStatus = $order->status;

            if ($orderCurrentStatus == OrderEnum::COMPLETED->name) {
                throw new Exception(__('Order Status Cannot Be Change because it is already completed'));
            }

            if ($orderCurrentStatus == OrderEnum::CANCELED->name) {
                throw new Exception(__('Order Status Cannot Be Change because it is already canceled'));
            }

//            $shipping_company = ShippingCompany::first();
//
//            if (is_null($shipping_company)) {
//                throw new Exception('لا يوجد شركة نقل');
//            }
//
//            if (! empty($order->delivery_fee) || $order->delivery_fee == 00.0) {
//                $order->update([
//                    'shipping_company_id' => $shipping_company->id,
//                ]);
//            }
//

            $status_can_updated = $order->expectsStatus($status);

            if (! $status_can_updated['status']) {
                throw new Exception($status_can_updated['message']);
            }

            $order->update([
                'status' => $status,
            ]);

            if ($status == OrderEnum::READY_TO_DELIVERY && ! empty($order->shipping_company_id)) {
                $order->shippingCompany->notify(new ReadyOrderOnDeliveryNotification($order));
                foreach ($order->shippingCompany()->deliveries as $delivery) {
                    $delivery->notify(new ReadyOrderOnDeliveryNotification($order));
                }
            }

            if ($status == OrderEnum::CANCELED->name) {
                $sellerCurrentPoints = $order->seller->current_points;
                $order->seller->update([
                    'current_points' => $sellerCurrentPoints + $order->points,
                ]);
            }

            if ($status == OrderEnum::COMPLETED->name && $order->points != 0) {
                $order->seller->creditSellerByOrderPoint($order->seller->id, $order->points);
            }

            if ($status == OrderEnum::COMPLETED->name) {
                $order->seller->notify(new OrderAcceptedNotification($order));
            }

            if ($status == OrderEnum::CANCELED->name) {
                $order->seller->notify(new OrderCanceledNotification($order));
            }
        });
    }

    public function getCount()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('seller_id', $seller->id)->count();
    }

    public function getDailyCount()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('seller_id', $seller->id)->groupBy(DB::raw("DATE_FORMAT(created_at, '%d')"))->count();
    }

    public function getMonthlyCount()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return Order::query()->where('seller_id', $seller->id)->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"))->count();
    }

    public function getPoints($request): array
    {
        $products = self::handleRequest($request);

        $result = [];

        foreach ($products as $storeSeller => $product) {
            $storeSeller = Seller::query()->find($storeSeller);

            $storeSellerPoints = $storeSeller->current_points;

            $points = collect($product)->sum(function ($p) {
                if ($p['points']) {
                    return $p['points'] * $p['qty'];
                }

                return 0;
            });

            $result[] = [
                'seller_name' => $storeSeller->name,
                'is_seller_has_enough_points' => $storeSellerPoints >= $points && $storeSellerPoints != 0,
            ];
        }

        return $result;
    }
}
