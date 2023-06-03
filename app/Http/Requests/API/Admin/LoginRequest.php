<?php

namespace App\Http\Requests\API\Admin;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function authenticate(): Admin
    {
        $this->ensureIsNotRateLimited();

        $admin = Admin::where('username', $this->input('username'))->first();

        if (! $admin || ! Hash::check($this->input('password'), $admin->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $admin->update([
            'device_token' => $this->input('device_token'),
        ]);

        $admin->refresh();

        return $admin;
    }

    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'mintues' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('username') . '|' . $this->ip());
    }
}
