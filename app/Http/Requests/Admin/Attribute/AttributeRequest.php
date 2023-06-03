<?php

namespace App\Http\Requests\Admin\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => $this->isMethod('PUT') ? ('required|string|unique:attributes,title->ar,' . $this->route('governorate')) : 'required|string|unique:attributes,title->ar',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
