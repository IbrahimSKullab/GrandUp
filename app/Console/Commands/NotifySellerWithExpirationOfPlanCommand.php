<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Seller;
use Illuminate\Console\Command;
use App\Notifications\Seller\WarningSellerWithPlanExpirationNotification;

class NotifySellerWithExpirationOfPlanCommand extends Command
{
    protected $signature = 'notify:seller-with-expiration-of-plan';

    protected $description = 'Command description';

    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');

        // Before Two Days
        $sellers = Seller::query()
            ->where('two_days_before_plan_expiration', $now)
            ->where('seller_notified_before_two_days', false)
            ->get();
        foreach ($sellers as $seller) {
            if ($seller->plan_expired_at) {
                $diffInDays = Carbon::now()->diffInDays(Carbon::parse($seller->plan_expired_at));
                $seller->notify(new WarningSellerWithPlanExpirationNotification($diffInDays));
                $seller->update([
                    'seller_notified_before_two_days' => true,
                ]);
            }
        }

        // Before One Day
        $sellers = Seller::query()->where('one_days_before_plan_expiration', $now)->where('seller_notified_before_one_days', false)->get();
        foreach ($sellers as $seller) {
            $diffInDays = Carbon::now()->diffInDays(Carbon::parse($seller->plan_expired_at));
            $seller->notify(new WarningSellerWithPlanExpirationNotification($diffInDays));
            $seller->update([
                'seller_notified_before_one_days' => true,
            ]);
        }

        // In Expiration Date
        $sellers = Seller::query()->where('plan_expired_at', $now)->where('seller_notified_in_expiration_date', false)->get();
        foreach ($sellers as $seller) {
            $diffInDays = Carbon::now()->diffInDays(Carbon::parse($seller->plan_expired_at));
            $seller->notify(new WarningSellerWithPlanExpirationNotification($diffInDays));
            $seller->update([
                'seller_notified_in_expiration_date' => true,
            ]);
        }
    }
}
