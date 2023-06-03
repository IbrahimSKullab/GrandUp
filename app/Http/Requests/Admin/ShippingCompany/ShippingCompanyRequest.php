<?php

namespace App\Http\Requests\Admin\ShippingCompany;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'current_points' => 'numeric|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
