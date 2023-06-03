<?php

namespace App\Http\Requests\Admin\IntroImage;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class IntroImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => 'required|string',
            'description' => 'required|array|min:1',
            'description.ar' => 'required|string',
            'type' => 'required|in:seller,user,general_store',
            'image' => Helper::imageRules($this->isMethod('PUT')),
        ];
    }
}
