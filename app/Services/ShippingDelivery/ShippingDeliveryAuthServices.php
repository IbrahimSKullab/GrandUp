<?php

namespace App\Services\ShippingDelivery;

use Exception;
use App\Enums\ShippingEnum;
use App\Models\ShippingDelivery;
use Illuminate\Support\Facades\Hash;

class ShippingDeliveryAuthServices
{
    public function generateOtp(ShippingDelivery $shipping_delivery): void
    {
        if (config('app.env') == 'production') {
            $code = 123456;
        } else {
            $code = 123456;
        }

        $shipping_delivery->update([
            'hashed_login_otp' => Hash::make($code),
        ]);
    }

    public function verifyOtp($phone, $otpCode)
    {
        $shipping_delivery = ShippingDelivery::query()->where('phone', $phone)->first();

        if (is_null($shipping_delivery)) {
            throw new Exception(__('Shipping Delivery not found'));
        }

        if (! Hash::check($otpCode, $shipping_delivery->hashed_login_otp)) {
            throw new Exception(__('Invalid Code'));
        }

        $shipping_delivery->update([
            'hashed_login_otp' => null,
        ]);

        $shipping_delivery->tokens()->delete();
        if ($shipping_delivery && $shipping_delivery?->account_status == ShippingEnum::REQUIRE_APPROVAL->value && $shipping_delivery?->account_status == ShippingEnum::SUSPENDED->value) {
            throw new Exception(__('Your account still in activation process'));
        }

        return $shipping_delivery;
    }
}
