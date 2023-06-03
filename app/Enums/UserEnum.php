<?php

namespace App\Enums;

enum UserEnum: string
{
    case MALE = 'MALE';

    case  FEMALE = 'FEMALE';

    case USER_PROFILE_COLLECTION_NAME = 'USER_PROFILE_COLLECTION';

    public function getUserSex(): array
    {
        return match ($this) {
            UserEnum::MALE => __('Male'),
            UserEnum::FEMALE => __('Female')
        };
    }
}
