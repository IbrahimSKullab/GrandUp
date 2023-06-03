<?php

namespace App\Http\Controllers\API\V1\ShippingDelivery;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Seller;
use App\Enums\OrderEnum;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\ShippingDelivery;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Notifications\Shipping\OrderCompleteNotification;

class ShippingDeliveryController extends Controller
{
    public function __construct()
    {
    }

    public function getOrders(Request $request): JsonResponse
    {
        $shipping_delivery = ShippingDelivery::findOrFail(auth()->user()->id);

        $orders = Order::query()->where('shipping_company_id', $shipping_delivery->shipping_company_id);

        $orders->when(! empty($request->status), function ($q) use ($request, $shipping_delivery) {
            if ($request->status == 'CURRENT') {
                return $q->where('shipping_delivery_id', $shipping_delivery->id)->whereIN('status', [OrderEnum::IN_DELIVERY->value, OrderEnum::IN_THE_WAY->value]);
            } elseif ($request->status == 'PREVIOUS') {
                return $q->where('shipping_delivery_id', $shipping_delivery->id)->where('status', OrderEnum::COMPLETED->value);
            } elseif ($request->status == 'NEW') {
                return $q->whereNull('shipping_delivery_id')->where('status', OrderEnum::READY_TO_DELIVERY->value);
            }
        });

        $data = $orders->latest()->customPagination()->get();

        $response = OrderResource::collection($data);

        return $this::sendSuccessResponse($response);
    }

    public function getOrder($id): JsonResponse
    {
        $shipping_delivery = ShippingDelivery::findOrFail(auth()->user()->id);

        $order = Order::where('shipping_delivery_id', $shipping_delivery->id)->findOrFail($id);

        $response = new OrderResource($order);

        return $this::sendSuccessResponse($response);
    }

    public function changeStatus(Request $request, $id): JsonResponse
    {
        $shipping_delivery = ShippingDelivery::findOrFail(auth()->user()->id);
        $shipping_company = ShippingCompany::where('id', $shipping_delivery->shipping_company_id)->first();
        $order = Order::where('id', $request->order_id)->first();

        if ($request->status == 'IN_DELIVERY') {
            $order->update([
                'shipping_delivery_id' => $shipping_delivery->id,
            ]);
        }

        $status_can_updated = $order->expectsStatus($request->status);

        if (! $status_can_updated['status']) {
            throw new Exception($status_can_updated['message']);
        }

        if (! empty($order->user_id)) {
            $user = User::where('id', $order->user_id)->first();
        } else {
            $seller = Seller::where('id', $order->user_seller_id)->first();
        }

        switch ($request->status) {
            case 'IN_DELIVERY':
                $order->update([
                    'status' => OrderEnum::IN_DELIVERY->value,
                ]);
                $order->histories()->create([
                    'created_by' => auth()->user()->id,
                    'comment' => OrderEnum::IN_DELIVERY->value,
                ]);

                break;
            case 'IN_THE_WAY':
                $order->update([
                    'status' => OrderEnum::IN_THE_WAY->value,
                ]);
                $order->histories()->create([
                    'created_by' => auth()->user()->id,
                    'comment' => OrderEnum::IN_THE_WAY->value,
                ]);

                break;
            case 'COMPLETED':
                $order->update([
                    'status' => OrderEnum::COMPLETED->value,
                ]);
                $order->histories()->create([
                    'created_by' => auth()->user()->id,
                    'comment' => OrderEnum::COMPLETED->value,
                ]);
                $shipping_company->notify(new OrderCompleteNotification($order));
                if (! empty($order->user_id)) {
                    $user->notify(new OrderCompleteNotification($order));
                } else {
                    $seller->notify(new OrderCompleteNotification($order));
                }

                break;
        }

        $response = new OrderResource($order);

        return $this::sendSuccessResponse($response);
    }
}
