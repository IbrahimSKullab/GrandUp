<?php

namespace App\Http\Requests\API\Auth\Pos;

use Exception;
use App\Models\Admin;
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

    public function authenticate(): Admin
    {
        $this->ensureIsNotRateLimited();

        $pos = Admin::where('phone', $this->input('phone'))->first();

        if ($pos && $pos?->status == false) {
            throw new Exception(__('Your account still in activation process'));
        }

        if (! $pos) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $pos->update([
            'device_token' => $this->input('device_token'),
        ]);

        $pos->refresh();

        return $pos;
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
