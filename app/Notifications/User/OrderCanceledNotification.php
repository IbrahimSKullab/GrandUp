<?php

namespace App\Notifications\User;

use App\Models\Order;
use App\Helper\Helper;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCanceledNotification extends Notification
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
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
            'ar' => 'تم رفض طلبك من قبل البائع',
            'en' => 'Your order has been canceled by the seller',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->order->seller->name,
            'en' => $this->order->seller->name,
        ];
    }

    public function image()
    {
        return $this->order->seller->profile_image;
    }
}
