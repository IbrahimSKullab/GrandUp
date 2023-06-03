<?php

namespace App\Actions\NotificationActions;

use App\Models\Admin;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Notifications\User\NewUserRegisteredNotification;

class NotifyAdminsWithNewUserAction
{
    use AsAction;

    public function handle($user): void
    {
        $admins = Admin::query()->where('status', 1)->get();

        $admins->map(function (Admin $admin) use ($user) {
            if ($admin->hasPermissionTo('users')) {
                $admin->notify(new NewUserRegisteredNotification($user));
            }
        });
    }
}
