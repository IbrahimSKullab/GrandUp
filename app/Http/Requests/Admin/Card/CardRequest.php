<?php

namespace App\Http\Requests\Admin\Card;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => [
                'required',
                Rule::unique('cards', 'title->ar')->ignore($this->route('card')),
            ],
            'type' => 'required|in:1,2,3,4',
            'card_price' => 'required|numeric|integer|min:1',
            'points' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
