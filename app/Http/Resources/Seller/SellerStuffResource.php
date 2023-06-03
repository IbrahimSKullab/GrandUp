<?php

namespace App\Http\Resources\Seller;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $phone
 * @property mixed $country
 * @property mixed $governorate
 * @property mixed $profile_image
 * @property mixed $account_status
 * @property mixed $permissions

 */
class SellerStuffResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'country' => CountryResource::make($this->country),
            'governorate' => GovernorateResource::make($this->governorate),
            'profile_image' => $this->profile_image,
            'account_status' => $this->account_status,
            'permissions' => PermissionResource::collection($this->permissions),
        ];
    }
}
