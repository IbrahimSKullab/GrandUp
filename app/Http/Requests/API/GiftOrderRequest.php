<?php

namespace App\Http\Requests\API;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GiftOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'gifts' => 'array|min:1',
            'gifts.*.gift_id' => [
                'required',
                Rule::exists('gifts', 'id')->where('status', 1),
            ],
            'gifts.*.qty' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
