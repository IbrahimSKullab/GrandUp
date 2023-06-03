<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use App\Http\Resources\Seller\SellerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSharedResponse extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'product' => new ProductResource($this->sellerProduct),
            'seller' => new SellerResource($this->sellerUser),
        ];
    }
}
