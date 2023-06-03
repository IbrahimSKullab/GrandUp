<?php

namespace App\Http\Resources\Pos;

use App\Enums\AdminEnum;
use Illuminate\Http\Request;
use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class PosResource extends JsonResource
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
            'phone' => $this->phone,
            'address' => $this->address,
            'pos_current_points' => $this->pos_current_points,
            'image' => $this->getFirstMediaUrl(AdminEnum::POS_IMAGE->name),
            'country' => CountryResource::make($this->country),
            'governorate' => GovernorateResource::make($this->governorate),
        ];
    }
}
