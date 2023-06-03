<?php

namespace App\Http\Requests\Admin\SellerViolation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerViolationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'notes' => 'required|array|min:1',
            'notes.ar' => $this->isMethod('PUT') ? ('required|string|unique:seller_violations,notes->ar,' . $this->route('governorate')) : 'required|string|unique:seller_violations,notes->ar',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
