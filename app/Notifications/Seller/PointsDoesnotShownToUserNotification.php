<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PointsDoesnotShownToUserNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['firebase', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => $this->title(),
            'content' => $this->content(),
            'image' => $this->image(),
        ];
    }

    public function toFirebase($notifiable)
    {
        Helper::sendFirebaseNotification(
            $notifiable->device_token,
            $this->title()[$notifiable->default_lang],
            $this->content()[$notifiable->default_lang]
        );
    }

    public function title(): array
    {
        return [
            'ar' => 'النقاط لا تظهر على منتجاتك',
            'en' => 'Points do not appear on your products',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => 'برجاء شحن نقاط',
            'en' => 'Please charge points',
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
