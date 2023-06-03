<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\NotificationRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotificationRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly NotificationRequest $notificationRequest)
    {
    }

    public function handle()
    {
        $count = $this->notificationRequest->number_of_notification;
        $users = User::query()->where('enable_notification', 1)->take($count ?? 1)->inRandomOrder()->get();
        foreach ($users as $user) {
            $user->notify(new ProductNotification($this->notificationRequest->product));
        }
        $this->notificationRequest->update([
            'notification_sending_process_completed' => 1,
        ]);
    }
}
