<?php

namespace App\Http\Requests\POS;

use Illuminate\Foundation\Http\FormRequest;

class ChargingCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'card_id' => 'required|exists:cards,id',
            'count' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
