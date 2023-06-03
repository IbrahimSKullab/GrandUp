<?php

namespace App\Http\Requests\Admin\Gift;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array',
            'title.ar' => 'required|string',
            'description' => 'required|array',
            'description.ar' => 'required|string',
            'points' => 'required|numeric|integer|min:1',
            'image' => Helper::imageRules($this->isMethod('PUT')),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
