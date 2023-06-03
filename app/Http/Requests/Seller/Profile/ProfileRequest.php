<?php

namespace App\Http\Requests\Seller\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'governorate_id' => 'required|exists:governorates,id',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
