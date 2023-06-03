<?php

namespace App\Services\User;

use Hash;
use Exception;
use App\Models\User;
use App\Helper\Helper;
use Laravel\Sanctum\PersonalAccessToken;

class UserAuthServices
{
    public function checkPhoneIfExists($phone): bool
    {
        return User::query()->where('phone', $phone)->exists();
    }

    public function checkEmailIfExists($phone): bool
    {
        return User::query()->where('email', $phone)->exists();
    }

    public function generateOtp(User $user): void
    {
        if (config('app.env') == 'production') {
//            $code = random_int(100000,999999);
//
//            Helper::sendOTP($user->phone, $code);

            $code = 123456;
        } else {
            $code = 123456;
        }

        $user->update([
            'hashed_login_otp' => Hash::make($code),
        ]);
    }

    public function verifyOtp($phone, $otpCode)
    {
        $user = User::query()->where('phone', $phone)->first();

        if (is_null($user)) {
            throw new Exception(__('User not found'));
        }

        if (! Hash::check($otpCode, $user->hashed_login_otp)) {
            throw new Exception(__('Invalid Code'));
        }

        $user->update([
            'hashed_login_otp' => null,
        ]);

        $user->tokens()->delete();

        $this->checkUser($user);

        return $user;
    }

    public function getUserByToken($access_token, $device_token = null)
    {
        $user = PersonalAccessToken::findToken($access_token);

        if (is_null($user)) {
            throw new Exception(__('User not found'));
        }

        if ($user?->tokenable instanceof User) {
            $currentUser = User::query()->find($user->tokenable->id);
        } else {
            throw new Exception(__('User not found'));
        }

        $currentUser->update([
            'device_token' => ! is_null($device_token) ? $device_token : $currentUser->device_token,
        ]);

        return $currentUser;
    }

    public function checkUser($user): void
    {
        if ($user->status == 0) {
            $user->tokens()->delete();

            throw new Exception(__('Your Account is suspended please contact support'));
        }
    }
}
