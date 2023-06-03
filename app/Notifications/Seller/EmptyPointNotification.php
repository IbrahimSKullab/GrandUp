<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\Seller;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmptyPointNotification extends Notification
{
    private Seller $seller;

    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
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
            'ar' => 'تم نفاذ جميع نقاطك برجاء شحن النقاط',
            'en' => 'All your points have been sold out. Please recharge the points',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->seller->current_points,
            'en' => $this->seller->current_points,
        ];
    }

    public function image()
    {
        return $this->seller->profile_image;
    }
}
