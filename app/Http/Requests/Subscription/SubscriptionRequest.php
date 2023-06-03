<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array|min:1',
            'description' => 'required|array|min:1',
            'subscription_type' => 'required|in:months,years,days',
            'subscription_period' => 'required|numeric|integer',
            'points' => ! $this->boolean('free_plan') ? 'required|numeric|min:0' : '',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
