<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\SubCategory\SubCategoryResource;

class ProductMiniResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,

            'is_shared' => (boolean)$this->is_shared,

            'status' => $this->status,
            'video_link' => $this->video_link,
            'price' => $this->price,

            'special_price' => $this->special_price,

            'category' => $this->whenLoaded('category', fn () => CategoryResource::make($this->category)),
            'sub_category' => $this->whenLoaded('subCategory', fn () => SubCategoryResource::make($this->subCategory)),
            'points' => $this->points,
            'image' => $this->image,
            'share_product' => (boolean)$this->is_editable,
        ];
    }
}
