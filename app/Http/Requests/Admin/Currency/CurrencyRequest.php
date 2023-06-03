<?php

namespace App\Http\Requests\Admin\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => $this->isMethod('PUT') ? ('required|string|unique:currencies,title->ar,' . $this->route('country')) : 'required|string|unique:currencies,title->ar',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
