<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'first_phone' => $this->first_phone,
            'second_phone' => $this->second_phone,
            'facebook_link' => $this->facebook_link,
            'twitter_link' => $this->twitter_link,
            'instagram_link' => $this->instagram_link,
            'linkedin_link' => $this->linkedin_link,
            'snapchat_link' => $this->snapchat_link,
            'youtube_link' => $this->youtube_link,
            'tiktok_link' => $this->tiktok_link,
        ];
    }
}
