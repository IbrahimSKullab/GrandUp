<?php

namespace App\Http\Requests\Category;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'image' => ($this->isMethod('POST') && $this->category_id == 'make-main-category') ? ['required', Helper::imageRules($this->isMethod('PUT'))] : 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
