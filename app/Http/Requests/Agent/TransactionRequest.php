<?php

namespace App\Http\Requests\Agent;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        $table = 'users';
        if ($this->get('type') == 'seller') {
            $table = 'sellers';
        }
        if ($this->get('type') == 'user') {
            $table = 'users';
        }
        if ($this->get('type') == 'pos') {
            $table = 'admins';
        }

        return [
            'type' => 'required|in:pos,seller,user',
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
        return [
            'phone.required' => __('Phone Field not found'),
            'phone.exists' => __('Pos not found'),
            'points.required' => __('Point is required'),
            'points.numeric' => __('Point must be number'),
            'points.integer' => __('Point must be integer number'),
            'model_id.required' => __('Please search for user before send point to ensure you want to send to correct pos'),
        ];
    }
}
