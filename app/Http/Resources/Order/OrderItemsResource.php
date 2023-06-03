<?php

namespace App\Http\Resources\Order;

use App\Helper\Helper;
use App\Enums\ProductEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id,
                'title' => $this->product->title,
                'code' => $this->product->code,
                'points' => $this->product->points,
                'description' => $this->product->description,
                'image' => $this->product->image,
                'qr_code' => $this->product->qr_code,
                'product_dynamic_link' => $this->product->product_dynamic_link,
                'images' => Helper::getModelMultiMediaUrls($this->product, ProductEnum::PRODUCT_IMAGES_COLLECTION->name),
            ],
            'product_price' => $this->product_price,
            'product_price_currency' => $this->product_price_currency,
            'is_ordinary_price' => $this->is_ordinary_price,
            'is_special_price' => $this->is_special_price,
            'qty' => $this->qty,
        ];
    }
}
