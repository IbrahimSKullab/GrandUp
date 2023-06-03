<?php

namespace App\Http\Requests\API\Auth\Seller;

use Exception;
use App\Models\Seller;
use App\Enums\SellerEnum;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'app_version' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|in:ios,android',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function authenticate(): Seller
    {
        $this->ensureIsNotRateLimited();

        $seller = Seller::where('phone', $this->input('phone'))->first();

        if ($seller?->account_status == SellerEnum::REQUIRE_APPROVAL->name) {
            throw new Exception(__('Your account still in activation process'));
        }

        if (! $seller) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $seller->update([
            'app_version' => $this->input('app_version'),
            'device_token' => $this->input('device_token'),
            'device_type' => $this->input('device_type'),
        ]);

        $seller->refresh();

        return $seller;
    }

    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'auth' => trans('auth.throttle', [
                'seconds' => $seconds,
                'mintues' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('auth') . '|' . $this->ip());
    }
}
