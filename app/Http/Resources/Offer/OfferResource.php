<?php

namespace App\Http\Resources\Offer;

use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'days' => $this->days,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'product' => ProductResource::make($this->product),
        ];
    }
}
