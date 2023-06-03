<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSellerStuffRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => ['required', 'numeric', Rule::unique('sellers')->ignore($this->id)],
            'country_id' => 'required|exists:governorates,id',
            'governorate_id' => 'required|exists:governorates,id',
            'password' => 'sometimes|min:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
