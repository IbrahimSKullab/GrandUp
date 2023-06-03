<?php

namespace App\Http\Requests\API\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddOrDeleteFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'favoritable' => ['required','string','in:seller,product'],
            'favoritable_id' => ['required','numeric'],
            ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
