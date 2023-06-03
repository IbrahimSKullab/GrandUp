<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => $this->isMethod('PUT') ? ('required|string|unique:countries,title->ar,' . $this->route('country')) : 'required|string|unique:countries,title->ar',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
