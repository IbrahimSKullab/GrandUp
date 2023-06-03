<?php

namespace App\Models;

use App\Enums\GiftEnum;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasPaginationTrait;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Gift extends BaseModel implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    use HasPaginationTrait;

    public array $translatable = ['title', 'description'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(GiftEnum::GIFT_CARD_IMAGE->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(GiftEnum::GIFT_CARD_IMAGE->name);
        });
    }
}
