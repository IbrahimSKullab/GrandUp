<?php

namespace App\Models;

use App\Enums\GeneralSettingEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = [
        'title',
        'description',
        'seller_registration_content',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(GeneralSettingEnum::LOGO_IMAGE->value)->singleFile();
        $this->addMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE->value)->singleFile();
        $this->addMediaCollection(GeneralSettingEnum::FAVICON->value)->singleFile();
    }

    public function logo(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::LOGO_IMAGE->value);
        });
    }

    public function favicon(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::FAVICON->value);
        });
    }

    public function defaultProfileImage(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE->value);
        });
    }
}
