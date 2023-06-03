<?php

namespace App\Http\Requests\Seller\Profile;

use App\Enums\GuardEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => 'current_password:' . GuardEnum::SELLER->value,
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
