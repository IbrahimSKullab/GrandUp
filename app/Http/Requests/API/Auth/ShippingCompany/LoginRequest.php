<?php

namespace App\Http\Requests\API\Auth\ShippingCompany;

use App\Enums\ShippingEnum;
use App\Models\ShippingCompany;
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

    public function authenticate(): ShippingCompany
    {
        $this->ensureIsNotRateLimited();

        $shipping_company = ShippingCompany::where('phone', $this->input('phone'))->first();

        if ($shipping_company && $shipping_company?->account_status == ShippingEnum::REQUIRE_APPROVAL && $shipping_company?->account_status == ShippingEnum::SUSPENDED) {
            throw new Exception(__('Your account still in activation process'));
        }
        if (! $shipping_company) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $shipping_company->update([
            'device_token' => $this->input('device_token'),
        ]);

        $shipping_company->refresh();

        return $shipping_company;
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
