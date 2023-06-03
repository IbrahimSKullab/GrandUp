<?php

namespace App\Http\Resources\Seller;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

/**
 * @property mixed $id
 * @property mixed $name
 */
class PermissionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'name' => $this->name,
        ];
    }
}
