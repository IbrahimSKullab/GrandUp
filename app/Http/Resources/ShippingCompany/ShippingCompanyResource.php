<?php

namespace App\Http\Resources\ShippingCompany;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class ShippingCompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'current_points' => $this->current_points,
            'orders_count' => $this->orders_count,
            'deliveries_count' => $this->deliveries_count,
            'default_lang' => $this->default_lang,
        ];
    }
}
