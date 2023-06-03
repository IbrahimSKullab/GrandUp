<?php

namespace App\Http\Requests\API\ShippingCompany;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => request()->is('store') ? ['required', 'string', Rule::unique('shipping_deliveries')] : ['required', 'string'],
            'country_id' => 'required|exists:governorates,id',
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }


}
