<?php

namespace App\Http\Requests\Admin\User;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => $this->isMethod('PUT') ? 'nullable' : 'required|string|unique:users,phone',
            'governorate_id' => 'required|exists:governorates,id',
            'address' => 'required|string',
            'profile_image' => 'nullable|mimetypes:' . implode(',', Media::$IMAGES_MIMES_TYPES),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
