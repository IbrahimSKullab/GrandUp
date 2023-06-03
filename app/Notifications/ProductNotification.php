<?php

namespace App\Notifications;

use App\Helper\Helper;
use App\Models\SellerProduct;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductNotification extends Notification
{
    private SellerProduct $sellerProduct;

    public function __construct(SellerProduct $sellerProduct)
    {
        $this->sellerProduct = $sellerProduct;
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
            'url' => route('admin.product.show', $this->sellerProduct->id),
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
            'ar' => $this->sellerProduct->title,
            'en' => $this->sellerProduct->title,
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->sellerProduct->description,
            'en' => $this->sellerProduct->description,
        ];
    }

    public function image()
    {
        return $this->sellerProduct->image;
    }
}
