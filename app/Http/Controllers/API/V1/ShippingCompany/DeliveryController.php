<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Enums\ShippingEnum;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\ShippingDelivery;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShippingCompany\DeliveryRequest;
use App\Http\Resources\ShippingDelivery\ShippingDeliveryResource;

class DeliveryController extends Controller
{
    public function index()
    {
        $shipping_company = ShippingCompany::findOrFail(auth()->user()->id);

        $deliveries = ShippingDelivery::where('shipping_company_id', $shipping_company->id)->get();

        return $this::sendSuccessResponse(ShippingDeliveryResource::collection($deliveries));
    }

    public function show($id)
    {
        $delivery = ShippingDelivery::findOrFail($id);

        return $this::sendSuccessResponse(new ShippingDeliveryResource($delivery));
    }

    public function store(DeliveryRequest $request)
    {
        $input = $request->all();
        $shipping_company = ShippingCompany::findOrFail(auth()->user()->id);
        $input['shipping_company_id'] = $shipping_company->id;
        $delivery = ShippingDelivery::create($input);

        return $this::sendSuccessResponse(new ShippingDeliveryResource($delivery));
    }

    public function update(DeliveryRequest $request, $id)
    {
        $input = $request->all();
        $delivery = ShippingDelivery::findOrFail($id);

        $delivery->update($input);

        return $this::sendSuccessResponse(new ShippingDeliveryResource($delivery));
    }

    public function ChangeStatus($id)
    {
        $delivery = ShippingDelivery::findOrFail($id);

        if ($delivery->account_status == ShippingEnum::REQUIRE_APPROVAL->value && $delivery->account_status = ShippingEnum::SUSPENDED->value) {
            $delivery->account_status = ShippingEnum::ACCEPTED->value;
            $delivery->save();
        } else {
            $delivery->account_status = ShippingEnum::SUSPENDED->value;
            $delivery->save();
        }

        return $this::sendSuccessResponse(new ShippingDeliveryResource($delivery));
    }

    public function delete($id)
    {
        $delivery = ShippingDelivery::findOrFail($id);

        $delivery->delete();

        return $this::sendSuccessResponse('', __('Deleted Delivery'));
    }
}
