<?php

namespace App\Traits;

use App\Enums\UserEnum;
use App\Models\GeneralSetting;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasProfileImageTrait
{
    public function profileImage(): Attribute
    {
        return Attribute::get(function () {
            if ($this->hasMedia(UserEnum::USER_PROFILE_COLLECTION_NAME->value)) {
                return $this->getFirstMediaUrl(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            return GeneralSetting::query()->first()->default_profile_image;
        });
    }
}
