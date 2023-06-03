<?php

namespace App\Notifications\User;

use App\Models\User;
use App\Helper\Helper;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegisteredNotification extends Notification
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
            'url' => route('admin.user.show', $this->user->id),
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
            'ar' => 'تم تسجيل مستخدم جديد',
            'en' => 'New User Registered',
        ];
    }

    public function content(): array
    {
        return [
            'ar' => $this->user->name,
            'en' => $this->user->name,
        ];
    }

    public function image()
    {
        return $this->user->profile_image;
    }
}
