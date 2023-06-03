<?php

namespace App\Http\Requests\Admin\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class SellerTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|exists:sellers,phone',
            'points' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'phone.required' => __('Phone Field not found'),
            'phone.exists' => __('Seller not found'),
            'points.required' => __('Point is required'),
            'points.numeric' => __('Point must be number'),
            'points.integer' => __('Point must be integer number'),
        ];
    }
}
