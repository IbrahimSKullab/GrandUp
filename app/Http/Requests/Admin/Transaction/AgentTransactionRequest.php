<?php

namespace App\Http\Requests\Admin\Transaction;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AgentTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                Rule::exists('admins', 'phone')
                    ->where('is_pos', 0)
                    ->where('is_staff', 0)
                    ->where('is_agent', 1),
            ],
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
            'phone.exists' => __('Agent not found'),
            'points.required' => __('Point is required'),
            'points.numeric' => __('Point must be number'),
            'points.integer' => __('Point must be integer number'),
        ];
    }
}
