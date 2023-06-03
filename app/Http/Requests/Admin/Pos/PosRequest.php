<?php

namespace App\Http\Requests\Admin\Pos;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'phone' => 'required|string|unique:admins,phone,' . $this->route('po'),
            'governorate_id' => 'required|exists:governorates,id',
            'address' => 'required|string|max:150',
            'email' => 'required|string|max:50|unique:admins,email,' . $this->route('po'),
            'username' => 'required|string|max:50|unique:admins,username,' . $this->route('po'),
            'password' => $this->isMethod('PUT') ? 'nullable|confirmed|min:8' : 'required|confirmed|min:8',
            'image' => Helper::imageRules($this->isMethod('PUT')),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
