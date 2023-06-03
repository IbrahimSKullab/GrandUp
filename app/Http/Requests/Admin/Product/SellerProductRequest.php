<?php

namespace App\Http\Requests\Admin\Product;

use App\Helper\Helper;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SellerProductRequest extends FormRequest
{
    public function rules(): array
    {
        $sellerId = $this->get('seller_id');

        return [
            'seller_id' => 'required|exists:sellers,id',
            'title' => [
                'required',
                'array',
            ],
            'description' => [
                'required',
                'array',
            ],
            'seller_category_id' => [
                'nullable',
                Rule::exists('seller_categories', 'id'),
            ],
            'seller_sub_category_id' => [
                'nullable',
                Rule::exists('seller_sub_categories', 'id'),
            ],
            'code' => [
                'required',
                'string',
//                Rule::unique('seller_products', 'code')->where('seller_id', $sellerId)->ignore($this->route('product')),
            ],
            'image' => Helper::imageRules($this->isMethod('POST')),
            'images' => 'nullable|array',
            'images.*' => Helper::imageRules(true),
            'price' => 'required|numeric',
            'special_price' => 'required|numeric',
            'points' => 'nullable|numeric',
            'product_size' => 'nullable|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
