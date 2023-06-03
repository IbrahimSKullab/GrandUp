<?php

namespace App\Http\Resources\ShippingDelivery;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class ShippingDeliveryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'country' => new CountryResource($this->country),
            'governorate' => new GovernorateResource($this->governorate),
            'account_active_delivery' => $this->account_active,
            'account_status_shipping' => $this->account_status,
            'default_lang' => $this->default_lang,
        ];
    }
}
