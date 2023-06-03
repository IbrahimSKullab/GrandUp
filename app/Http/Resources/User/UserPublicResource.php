<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class UserPublicResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'governorate' => GovernorateResource::make($this->governorate),
            'phone' => $this->phone,
            'address' => $this->address,
            'profile_image' => $this->profile_image,
        ];
    }
}
