<?php

namespace App\Services\ShippingCompany;

use Exception;
use App\Enums\ShippingEnum;
use App\Models\ShippingCompany;
use Illuminate\Support\Facades\Hash;

class ShippingCompanyAuthServices
{
    public function generateOtp(ShippingCompany $shipping_company): void
    {
        if (config('app.env') == 'production') {
            $code = 123456;
        } else {
            $code = 123456;
        }

        $shipping_company->update([
            'hashed_login_otp' => Hash::make($code),
        ]);
    }

    public function verifyOtp($phone, $otpCode)
    {
        $shipping_company = ShippingCompany::query()->where('phone', $phone)->first();

        if (is_null($shipping_company)) {
            throw new Exception(__('Shipping Company not found'));
        }

        if (! Hash::check($otpCode, $shipping_company->hashed_login_otp)) {
            throw new Exception(__('Invalid Code'));
        }

        $shipping_company->update([
            'hashed_login_otp' => null,
        ]);

        $shipping_company->tokens()->delete();

        if ($shipping_company?->account_status == ShippingEnum::REQUIRE_APPROVAL->value || $shipping_company?->account_status == ShippingEnum::SUSPENDED->value) {
            throw new Exception(__('Your account still in activation process'));
        }

        return $shipping_company;
    }
}
