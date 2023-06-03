<?php

namespace App\Http\Requests\API\Auth\ShippingDelivery;

use App\Enums\ShippingEnum;
use App\Models\ShippingDelivery;
use Exception;
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
            'device_token' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function authenticate(): ShippingDelivery
    {
        $this->ensureIsNotRateLimited();

        $shipping_delivery = ShippingDelivery::where('phone', $this->input('phone'))->first();

        if ($shipping_delivery && $shipping_delivery?->account_status == ShippingEnum::REQUIRE_APPROVAL && $shipping_delivery?->account_status == ShippingEnum::SUSPENDED) {
            throw new Exception(__('Your account still in activation process'));
        }
        if (! $shipping_delivery) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $shipping_delivery->update([
            'device_token' => $this->input('device_token'),
        ]);

        $shipping_delivery->refresh();

        return $shipping_delivery;
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
