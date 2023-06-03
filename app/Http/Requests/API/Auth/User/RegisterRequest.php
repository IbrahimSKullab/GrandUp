<?php

namespace App\Http\Requests\API\Auth\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\User\UserServices;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Actions\NotificationActions\NotifyAdminsWithNewUserAction;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'nullable|email:dns,rfc|unique:users,email',
            'country_id' => 'required|exists:countries,id',
            'governorate_id' => 'required|exists:governorates,id',
            'address' => 'required|string',
            'app_version' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|in:ios,android',
        ];
    }

    public function register(): User
    {
        $this->ensureIsNotRateLimited();

        $user = DB::transaction(function () {
            $user = (new UserServices())->store(request());

            NotifyAdminsWithNewUserAction::run($user);

            $user->update([
                'app_version' => $this->get('app_version'),
                'device_token' => $this->get('device_token'),
                'device_type' => $this->get('device_type'),
            ]);

            $user->refresh();

            return $user;
        });

        if ($user) {
            RateLimiter::clear($this->throttleKey());
        }

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
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'mintues' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('email') . '|' . $this->ip());
    }
}
