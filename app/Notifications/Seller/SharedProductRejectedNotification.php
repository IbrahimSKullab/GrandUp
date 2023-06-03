<?php

namespace App\Notifications\Seller;

use App\Helper\Helper;
use App\Models\BlueTag;
use App\Models\SellerSharedProduct;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SharedProductRejectedNotification extends Notification
{
    private SharedProductRejectedNotification $shared_product_rejected_notification;

    public function __construct(SellerSharedProduct $product_shared)
    {
        $this->product_shared = $product_shared;
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
            //            'url' => route('admin.slider.show', $this->productAdsSlider->id),
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
            'ar' => 'تم قبول مشاركة المنتج',
            'en' => 'Product sharing accepted',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => 'تم رفض مشاركة المنتج'. $this->product_shared->sellerProduct->title .' من قبل التاجر '. $this->product_shared->seller->name .'',
            'en' => 'Product sharing rejected'. $this->product_shared->sellerProduct->title .' by the seller '. $this->product_shared->seller->name .'',
        ];
    }
}
