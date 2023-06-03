<?php

namespace App\Http\Requests\API\Auth\Seller;

use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Lockout;
use App\Services\Seller\SellerServices;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Actions\NotificationActions\NotifyAdminsWithNewSellerAction;

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
            'phone' => 'required|numeric|unique:sellers,phone',
            'email' => 'nullable|email:dns,rfc|unique:sellers,email',
            'username' => 'nullable|regex:/(^[a-zA-Z]+[a-zA-Z0-9\\_]*$)/u|unique:sellers,user_name',
            'governorate_id' => 'required|exists:governorates,id',
            'country_id' => 'required|exists:countries,id',
            'location' => 'required|string|max:255',
            'app_version' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|in:ios,android',
            'store_gps_location' => 'required|json',
        ];
    }

    public function register(): Seller
    {
        $this->ensureIsNotRateLimited();

        $seller = DB::transaction(function () {
            $seller = (new SellerServices())->store(request());

            NotifyAdminsWithNewSellerAction::run($seller);

            return $seller;
        });

        if ($seller) {
            RateLimiter::clear($this->throttleKey());
        }

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
