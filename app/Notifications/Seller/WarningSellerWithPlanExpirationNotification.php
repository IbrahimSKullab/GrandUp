<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WarningSellerWithPlanExpirationNotification extends Notification
{
    private $days;

    public function __construct($days)
    {
        $this->days = $days;
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
        if ($this->days == 2) {
            return [
                'ar' => 'سوف ينتهى الاشتراك بعد يومين برجاء التجديد المبكر',
                'en' => 'Subscription will expire after 2 days, please renew early',
            ];
        }
        if ($this->days == 1) {
            return [
                'ar' => 'سوف ينتهى الاشتراك بعد يوم برجاء التجديد المبكر',
                'en' => 'Subscription will expire after 1 days, please renew early',
            ];
        }
        if ($this->days == 0) {
            return [
                'ar' => 'تم إنهاء اشتراكك برجاء التجديد',
                'en' => 'Your subscription has been terminated, please renew',
            ];
        }
    }

    public function content(): array
    {
        return [
            'ar' => $this->days,
            'en' => $this->days,
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
