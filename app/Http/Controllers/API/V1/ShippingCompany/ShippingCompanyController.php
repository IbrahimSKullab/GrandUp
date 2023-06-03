<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Models\Order;
use App\Enums\OrderEnum;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Services\ShippingCompany\ShippingCompanyServices;
use App\Http\Resources\ShippingCompany\ShippingCompanyResource;

class ShippingCompanyController extends Controller
{
    public function __construct(
        private ShippingCompanyServices $shippingCompanyServices
    ) {
    }

    public function index()
    {
        return $this::sendSuccessResponse(ShippingCompanyResource::collection($this->shippingCompanyServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(ShippingCompanyResource::make($this->shippingCompanyServices->findById($id)));
    }

    public function home()
    {
        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        $order = Order::where('shipping_company_id', $shipping_company->id)->latest()->first();

        $order = ! empty($order) ? new OrderResource($order) : null;

        $data = [
            'current_points_count' => $shipping_company->current_points,
            'orders_count' => $shipping_company->orders_count,
            'deliveries_count' => $shipping_company->deliveries_count,
            'order' => $order,
        ];

        return $this::sendSuccessResponse($data);
    }

    public function getOrders(Request $request)
    {
        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        $orders = Order::query()->where('shipping_company_id', $shipping_company->id);

        $orders->when(! empty($request->status), function ($q) use ($request) {
            if ($request->status == 'CURRENT') {
                return $q->whereIN('status', [OrderEnum::READY_TO_DELIVERY->value, OrderEnum::IN_DELIVERY->value, OrderEnum::IN_THE_WAY->value]);
            } elseif ($request->status == 'PREVIOUS') {
                return $q->whereIN('status', [OrderEnum::COMPLETED->value]);
            }
        });

        $data = $orders->latest()->customPagination()->get();

        $response = OrderResource::collection($data);

        return $this::sendSuccessResponse($response);
    }

    public function getOrder($id)
    {
        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        $order = Order::where('shipping_company_id', $shipping_company->id)->findOrFail($id);

        $response = new OrderResource($order);

        return $this::sendSuccessResponse($response);
    }
}
