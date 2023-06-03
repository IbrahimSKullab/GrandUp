<?php

namespace App\Http\Requests\Admin\QrCode;

use Illuminate\Foundation\Http\FormRequest;

class QrCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'count' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
