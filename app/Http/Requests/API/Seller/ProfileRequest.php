<?php

namespace App\Http\Requests\API\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:sellers,phone,' . Auth::id(),
            'whatsapp_number' => 'required|numeric|unique:sellers,whatsapp_number,' . Auth::id(),
            'default_currency' => 'required|in:ID,DOLLAR',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
