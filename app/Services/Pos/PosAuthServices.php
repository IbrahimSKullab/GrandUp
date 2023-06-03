<?php

namespace App\Services\Pos;

use Exception;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PosAuthServices
{
    public function generateOtp(Admin $admin): void
    {
        if (config('app.env') == 'production') {
            $code = 123456;
        } else {
            $code = 123456;
        }

        $admin->update([
            'hashed_login_otp' => Hash::make($code),
        ]);
    }

    public function verifyOtp($phone, $otpCode)
    {
        $admin = Admin::query()->where('phone', $phone)->first();

        if (is_null($admin)) {
            throw new Exception(__('POS not found'));
        }

        if (! Hash::check($otpCode, $admin->hashed_login_otp)) {
            throw new Exception(__('Invalid Code'));
        }

        $admin->update([
            'hashed_login_otp' => null,
        ]);

        $admin->tokens()->delete();

        if ($admin && $admin?->status == false) {
            throw new Exception(__('Your account still in activation process'));
        }

        return $admin;
    }
}
