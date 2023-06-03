<?php

namespace App\Http\Requests\Admin\GeneralSettings;

use Illuminate\Foundation\Http\FormRequest;

class BasicInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => 'required|string',
            'description' => 'required|array|min:1',
            'description.ar' => 'required|string',
            'seller_registration_content' => 'nullable|array|min:1',
            'seller_registration_content.ar' => 'nullable|string',
            'first_email' => 'required',
            'second_email' => 'nullable',
            'first_phone' => 'required',
            'second_phone' => 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
