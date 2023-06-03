<?php

namespace App\Http\Requests\Admin\Agent;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|string|max:50|unique:admins,email,' . $this->route('agent'),
            'username' => 'required|string|max:50|unique:admins,username,' . $this->route('agent'),
            'phone' => 'required|string|unique:admins,phone,' . $this->route('agent'),
            'password' => $this->isMethod('PUT') ? 'nullable|confirmed|min:8' : 'required|confirmed|min:8',
            'pos_id' => 'required|array|min:1',
            'pos_id.*' => [
                'required',
                Rule::exists('admins', 'id')
                    ->where('is_staff', 0)
                    ->where('is_agent', 0)
                    ->where('is_pos', 1),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
