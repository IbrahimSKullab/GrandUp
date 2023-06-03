<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use App\Models\BlueTag;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RequestBlueTagRejectedNotification extends Notification
{
    private BlueTag $request_blue_tag;

    public function __construct(BlueTag $request_blue_tag)
    {
        $this->request_blue_tag = $request_blue_tag;
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
//            'image' => $this->image(),
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
            'ar' => 'تمت رفض طلب العلامة الزرقاء ',
            'en' => 'Blue tag request denied',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->request_blue_tag->rejection_reason,
            'en' => $this->request_blue_tag->rejection_reason,
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
