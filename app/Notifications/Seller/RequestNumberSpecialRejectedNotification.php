<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use App\Models\ProductAdsSlider;
use App\Models\RequestNumberSpecial;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RequestNumberSpecialRejectedNotification extends Notification
{
    private RequestNumberSpecial $request_number_special;

    public function __construct(RequestNumberSpecial $request_number_special)
    {
        $this->request_number_special = $request_number_special;
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
            'ar' => 'تمت رفض  الرقم المميز',
            'en' => 'Your offer request has been rejected for number special',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->request_number_special->rejection_reason,
            'en' => $this->request_number_special->rejection_reason,
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
