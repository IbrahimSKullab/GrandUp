<?php

namespace App\Http\Resources\IntroImages;

use App\Helper\Helper;
use App\Enums\IntroImagesEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroImagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => nl2br($this->description),
            'image' => Helper::getFirstMediaUrl($this, IntroImagesEnum::IMAGE->value),
        ];
    }
}
