<?php

namespace App\Http\Requests\Product;

use App\Helper\Helper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        $request = $this->request->all();
        if (isset($request['product_id'])) {
            return [];
        } else {
            return [
                'title' => [
                    'required',
                    'string',
                ],
                'description' => [
                    'required',
                    'string',
                ],
                'seller_category_id' => [
                    'nullable',
                    Rule::exists('seller_categories', 'id')->where('seller_id', Auth::id()),
                ],
                'seller_sub_category_id' => [
                    'nullable',
                    Rule::exists('seller_sub_categories', 'id')->where('seller_id', Auth::id()),
                ],
                'code' => [
                    'required',
                    'string',
                    //                Rule::unique('seller_products', 'code')->where('seller_id', Auth::id())->ignore($this->route('product')),
                ],
                'image' => Helper::imageRules($this->isMethod('POST')),
                'images' => 'nullable|array',
                'images.*' => Helper::imageRules(false),
                'price' => 'required|numeric',
                'special_price' => 'required|numeric',
                'points' => 'nullable|numeric',
            ];
        }
    }

    public function authorize(): bool
    {
        return true;
    }
}
