<?php

namespace App\Http\Requests\Admin\DeliveryRates;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRatesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'price' => 'required',
            'type' => 'required',
            'country_id' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
