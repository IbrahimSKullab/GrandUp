<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use App\Models\NotificationRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationRequestApprovedNotification extends Notification
{
    private NotificationRequest $notificationRequest;

    public function __construct(NotificationRequest $notificationRequest)
    {
        $this->notificationRequest = $notificationRequest;
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
            'ar' => 'تمت الموافقة على نشر إشعارك',
            'en' => 'Your notification request has been approved for publication',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->notificationRequest->date,
            'en' => $this->notificationRequest->date,
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
