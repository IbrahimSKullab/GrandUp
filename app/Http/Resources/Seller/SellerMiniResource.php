<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class SellerMiniResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'store_number' => $this->store_number,
            'description' => $this->description,
            'location' => $this->location,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsapp_number,
            'profile_image' => $this->profile_image,
            'country' => GovernorateResource::make($this->country),
            'governorate' => GovernorateResource::make($this->governorate),
            'review' => $this->_rating()

        ];
    }
}
