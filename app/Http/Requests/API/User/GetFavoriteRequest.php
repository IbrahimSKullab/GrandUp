<?php

namespace App\Http\Requests\API\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GetFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'favoritable' => ['required','string','in:product,seller'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
