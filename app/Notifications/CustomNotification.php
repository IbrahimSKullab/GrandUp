<?php

namespace App\Notifications;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomNotification extends Notification
{
    private \App\Models\CustomNotification $customNotification;

    public function __construct(\App\Models\CustomNotification $customNotification)
    {
        $this->customNotification = $customNotification;
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
        $image = $this->customNotification->getFirstMediaUrl('image');
        if ($image == '') {
            $image = GeneralSetting::query()->first()->logo;
        }

        return [
            'title' => [
                'ar' => $this->customNotification->title,
                'en' => $this->customNotification->title,
            ],
            'content' => [
                'ar' => $this->customNotification->description,
                'en' => $this->customNotification->description,
            ],
            'image' => $image,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (! is_null($notifiable->device_token)) {
            Helper::sendFirebaseNotification($notifiable->device_token, $this->customNotification->title, $this->customNotification->description);
        }
    }
}
