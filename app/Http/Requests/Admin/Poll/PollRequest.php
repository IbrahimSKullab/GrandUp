<?php

namespace App\Http\Requests\Admin\Poll;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'title.*' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.title' => 'required|array|min:1',
            'questions.*.title.ar' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
