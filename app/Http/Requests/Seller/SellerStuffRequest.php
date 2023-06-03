<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SellerStuffRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric|unique:sellers,phone',
            'country_id' => 'required|exists:governorates,id',
            'governorate_id' => 'required|exists:governorates,id',
            'password' => 'required|min:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
