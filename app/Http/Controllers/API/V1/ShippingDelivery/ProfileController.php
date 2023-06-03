<?php

namespace App\Http\Controllers\API\V1\ShippingDelivery;

use App\Enums\ShippingEnum;
use App\Models\ShippingDelivery;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingDelivery\ShippingDeliveryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $shipping_delivery = ShippingDelivery::findOrFail(auth()->user()->id);

        return $this::sendSuccessResponse(ShippingDeliveryResource::make($shipping_delivery));
    }

    public function logout()
    {

        $shipping_delivery = ShippingDelivery::findOrFail(auth()->user()->id);

        $shipping_delivery->tokens()->delete();

        return $this::sendSuccessResponse('', __('Logout'));
    }

    public function ChangeActive()
    {
        $delivery = ShippingDelivery::findOrFail(Auth::user()->id);

        if ($delivery->account_active == ShippingEnum::ACTIVE->value) {
            $delivery->account_active = ShippingEnum::NOT_ACTIVE->value;
            $delivery->save();
        } else {
            $delivery->account_active = ShippingEnum::ACTIVE->value;
            $delivery->save();
        }

        return $this::sendSuccessResponse(new ShippingDeliveryResource($delivery));
    }
}
