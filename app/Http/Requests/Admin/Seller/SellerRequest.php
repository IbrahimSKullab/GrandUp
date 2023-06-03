<?php

namespace App\Http\Requests\Admin\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'location' => 'required|string',
            'phone' => $this->isMethod('POST') ? 'required|string|unique:sellers,phone' : 'nullable',
            'seller_code' => 'required|string|unique:sellers,seller_code' . ($this->isMethod('PUT') ? (',' . $this->route('seller')) : ''),
            'governorate_id' => 'required|exists:governorates,id',
            'default_currency' => $this->isMethod('POST') ? 'required|in:ID,DOLLAR' : 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
