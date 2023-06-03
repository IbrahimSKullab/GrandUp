<?php

namespace App\Http\Resources\Slider;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'description' => $this->description,
            'product' => ProductResource::make($this->product),
        ];
    }
}
