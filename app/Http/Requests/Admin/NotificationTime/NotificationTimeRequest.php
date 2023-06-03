<?php

namespace App\Http\Requests\Admin\NotificationTime;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NotificationTimeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.ar' => 'required|string',
            'description' => 'required|array|min:1',
            'description.ar' => 'required|string',
            'number_of_notifications' => 'required|numeric|integer|min:1',
            'points' => 'required|numeric|integer|min:1',
            'notificationDates' => Rule::requiredIf($this->isMethod('POST')),
            'date' => Rule::requiredIf($this->isMethod('PUT')),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
