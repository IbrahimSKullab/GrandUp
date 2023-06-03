<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $status
 * @property mixed $seller_category_id
 */
class SubCategoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'image' => $this->image,
//            'status' => (bool)$this->status,
//            'category_id' => $this->seller_category_id,
        ];
    }
}
