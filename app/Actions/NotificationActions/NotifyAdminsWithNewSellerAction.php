<?php

namespace App\Actions\NotificationActions;

use App\Models\Admin;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Notifications\Seller\NewUserRegisteredNotification;

class NotifyAdminsWithNewSellerAction
{
    use AsAction;

    public function handle($seller): void
    {
        $admins = Admin::query()->where('status', 1)->get();

        $admins->map(function (Admin $admin) use ($seller) {
            if ($admin->hasPermissionTo('sellers')) {
                $admin->notify(new NewUserRegisteredNotification($seller));
            }
        });
    }
}
