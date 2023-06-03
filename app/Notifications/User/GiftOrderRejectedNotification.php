<?php

namespace App\Notifications\User;

use App\Helper\Helper;
use App\Models\GiftOrder;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GiftOrderRejectedNotification extends Notification
{
    private GiftOrder $giftOrder;

    public function __construct(GiftOrder $giftOrder)
    {
        $this->giftOrder = $giftOrder;
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
            'ar' => 'تم رفض طلب الهدية من قبل الإدارة',
            'en' => 'The gift request has been canceled by the administration',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => "كود الطلب {$this->giftOrder->order_code}",
            'en' => "Order Code {$this->giftOrder->order_code}",
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
