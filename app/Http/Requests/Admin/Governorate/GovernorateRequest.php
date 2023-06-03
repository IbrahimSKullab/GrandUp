<?php

namespace App\Http\Requests\Admin\Governorate;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'country_id' => 'required',
            'title.ar' => $this->isMethod('PUT') ? ('required|string|unique:governorates,title->ar,' . $this->route('governorate')) : 'required|string|unique:governorates,title->ar',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
