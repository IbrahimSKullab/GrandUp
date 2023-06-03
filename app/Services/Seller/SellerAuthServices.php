<?php

namespace App\Services\Seller;

use Exception;
use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\SellerEnum;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class SellerAuthServices
{
    public function checkPhoneIfExists($phone): bool
    {
        return Seller::query()->where('phone', $phone)->exists();
    }

    public function checkEmailIfExists($phone): bool
    {
        return Seller::query()->where('email', $phone)->exists();
    }

    public function generateOtp(Seller $seller): void
    {
        if (config('app.env') == 'production') {
//            $code = random_int(100000, 999999);
//
//            Helper::sendOTP($seller->phone, $code);

            $code = 123456;
        } else {
            $code = 123456;
        }

        $seller->update([
            'hashed_login_otp' => Hash::make($code),
        ]);
    }

    public function verifyOtp($phone, $otpCode)
    {
        $seller = Seller::query()->where('phone', $phone)->first();

        if (is_null($seller)) {
            throw new Exception(__('Seller not found'));
        }

        if (! Hash::check($otpCode, $seller->hashed_login_otp)) {
            throw new Exception(__('Invalid Code'));
        }

        $seller->update([
            'hashed_login_otp' => null,
        ]);

        $seller->tokens()->delete();

        $this->checkSeller($seller);

        return $seller;
    }

    public function getUserByToken($access_token, $device_token = null)
    {
        $seller = PersonalAccessToken::findToken($access_token);

        if (is_null($seller)) {
            throw new Exception(__('Seller not found'));
        }

        if ($seller?->tokenable instanceof Seller) {
            $currentSeller = Seller::query()->find($seller->tokenable->id);
        } else {
            throw new Exception(__('Seller not found'));
        }

        $currentSeller->update([
            'device_token' => ! is_null($device_token) ? $device_token : $currentSeller->device_token,
        ]);

        return $currentSeller;
    }

    public function checkSeller($seller): void
    {
        if ($seller->account_status == SellerEnum::REQUIRE_APPROVAL->name) {
            $seller->tokens()->delete();

            throw new Exception(__('Your Account is still in approval status'));
        }
        if ($seller->account_status == SellerEnum::SUSPENDED->name) {
            $seller->tokens()->delete();

            throw new Exception(__('Your Account is suspend, please contact support'));
        }
    }
}
