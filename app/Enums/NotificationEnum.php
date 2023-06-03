<?php

namespace App\Enums;

enum NotificationEnum
{
    case NEW_USER_REGISTER;

    case NEW_SELLER_REGISTER;

    case NEW_CONTACT_MESSAGE;

    public function label()
    {
        return match ($this) {
            NotificationEnum::NEW_CONTACT_MESSAGE => __('New Contact Message'),
            NotificationEnum::NEW_USER_REGISTER => __('New User Registered'),
            NotificationEnum::NEW_SELLER_REGISTER => __('New Seller Registered')
        };
    }

    public static function type($notificationCase)
    {
        return match ($notificationCase) {
            NotificationEnum::NEW_CONTACT_MESSAGE->name => __('New Contact Message'),
            NotificationEnum::NEW_USER_REGISTER->name => __('New User Registered'),
            NotificationEnum::NEW_SELLER_REGISTER->name => __('New Seller Registered'),
        };
    }
}
