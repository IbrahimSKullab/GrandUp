<?php

namespace App\Http\Requests\API\Auth\User;

use App\Models\User;
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

    public function authenticate(): User
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('phone', $this->input('phone'))->first();

        if (! $user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $user->update([
            'app_version' => $this->input('app_version'),
            'device_token' => $this->input('device_token'),
            'device_type' => $this->input('device_type'),
        ]);

        $user->refresh();

        return $user;
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
