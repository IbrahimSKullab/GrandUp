<?php

namespace App\Http\Resources\User;

use App\Helper\Helper;
use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_name' => $this->user_name,
            'country' => CountryResource::make($this->country),
            'governorate' => GovernorateResource::make($this->governorate),
            'address' => $this->address,
            'phone' => $this->phone,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'enable_notification' => $this->enable_notification,
            'current_points' => $this->current_points,
            'orders_count' => $this->orders_count,
            'friends_count' => $this->friends_count,
            'device_token' => $this->device_token,
            'device_type' => $this->device_type,
            'app_version' => $this->app_version,
            'default_lang' => $this->default_lang,
            'enable_features_search' => $this->enable_features_search,
            'enable_viewing_points' => $this->enable_viewing_points,
            'profile_image' => $this->profile_image,
            'created_at' => Helper::formatDate($this->created_at),
        ];
    }
}
