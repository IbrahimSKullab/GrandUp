<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\Subscription;
use App\Models\GeneralSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SellerSubscriptionNotification extends Notification
{
    private Subscription $subscription;
    private $days;

    public function __construct(Subscription $subscription, $days)
    {
        $this->subscription = $subscription;
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
        return [
            'ar' => "تم الاشتراك فى {$this->subscription->title}",
            'en' => "you have subscribed to {$this->subscription->title}",
        ];
    }

    public function content(): array
    {
        return [
            'ar' => "لمده {$this->days} يوم",
            'en' => "for {$this->days} days",
        ];
    }

    public function image()
    {
        return GeneralSetting::query()->first()->logo;
    }
}
