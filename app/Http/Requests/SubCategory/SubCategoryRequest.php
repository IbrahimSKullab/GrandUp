<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                Rule::unique('sub_categories', 'title->ar')->ignore($this->route('sub_category')),
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
