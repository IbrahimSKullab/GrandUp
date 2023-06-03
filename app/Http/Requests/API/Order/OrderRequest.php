<?php

namespace App\Http\Requests\API\Order;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'products' => 'required|array|min:1',
            'products.*.id' => [
                Rule::exists('seller_products', 'id')->where('status', 1)->where('admin_approval', 1),
            ],
            'products.*.qty' => 'required|numeric|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
