<?php

namespace App\Notifications;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReceivedPointNotification extends Notification
{
    private $points;

    public function __construct($points)
    {
        $this->points = $points;
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
            'ar' => "تم استلام {$this->points} نقطة",
            'en' => "you received {$this->points} point",
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->points,
            'en' => $this->points,
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
