<?php

namespace App\Notifications\Shipping;

use App\Models\Order;
use App\Helper\Helper;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderCompnyNotification extends Notification
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['database', 'firebase'];
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

    public function title(): array
    {
        return [
            'ar' => 'طلب توصيل جديد',
            'en' => 'new order to delivery',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->order->user->name . ' - ' . $this->order->code,
            'en' => $this->order->user->name . ' - ' . $this->order->code,
        ];
    }

    public function image()
    {
        return $this->order->user->profile_image;
    }

    public function toFirebase($notifiable)
    {
        Helper::sendFirebaseNotification(
            $notifiable->device_token,
            $this->title()[$notifiable->default_lang],
            $this->content()[$notifiable->default_lang]
        );
    }
}
