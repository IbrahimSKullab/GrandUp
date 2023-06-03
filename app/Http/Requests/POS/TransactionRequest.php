<?php

namespace App\Http\Requests\POS;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        $table = 'users';
        
        if ($this->get('type') == 'seller') {
            $table = 'sellers';
        }

        return [
            'type' => 'required|in:seller,user',
            'model_id' => 'required',
            'phone' => "required|exists:$table,phone",
            'points' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        if ($this->get('type') == 'seller') {
            return [
                'phone.required' => __('Phone Field not found'),
                'phone.exists' => __('Seller not found'),
                'points.required' => __('Point is required'),
                'points.numeric' => __('Point must be number'),
                'points.integer' => __('Point must be integer number'),
                'model_id.required' => __('Please search for seller before send point to ensure you want to send to correct seller'),
            ];
        }

        return [
            'phone.required' => __('Phone Field not found'),
            'phone.exists' => __('User not found'),
            'points.required' => __('Point is required'),
            'points.numeric' => __('Point must be number'),
            'points.integer' => __('Point must be integer number'),
            'model_id.required' => __('Please search for user before send point to ensure you want to send to correct user'),
        ];
    }
}
