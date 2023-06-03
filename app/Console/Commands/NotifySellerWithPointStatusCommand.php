<?php

namespace App\Console\Commands;

use App\Models\Seller;
use App\Models\GeneralSetting;
use Illuminate\Console\Command;
use App\Notifications\Seller\EmptyPointNotification;
use App\Notifications\Seller\PointsDoesnotShownToUserNotification;

class NotifySellerWithPointStatusCommand extends Command
{
    protected $signature = 'notify:seller-with-point-status';

    protected $description = 'Command description';

    public function handle()
    {
        $sellers = Seller::query()
            ->where('current_points', 0)
            ->where('seller_notified_with_empty_points', false)
            ->get();
        foreach ($sellers as $seller) {
            $seller->notify(new EmptyPointNotification($seller));
            $seller->update([
                'seller_notified_with_empty_points' => true,
            ]);
            $seller->refresh();
        }

        $minimumPoints = GeneralSetting::query()->first()->minimum_points_to_view_points_in_products;
        $sellers = Seller::query()
            ->where('current_points', '<=', $minimumPoints)
            ->where('seller_notified_with_points_doesnot_show', false)
            ->get();
        foreach ($sellers as $seller) {
            $seller->notify(new PointsDoesnotShownToUserNotification());
            $seller->update([
                'seller_notified_with_points_doesnot_show' => true,
            ]);
            $seller->refresh();
        }
    }
}
