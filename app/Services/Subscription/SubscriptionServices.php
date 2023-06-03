<?php

namespace App\Services\Subscription;

use DB;
use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\Seller;
use App\Models\Subscription;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\Seller\SellerSubscriptionNotification;

class SubscriptionServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Subscription::query()->latest()->get();
    }

    public function getEnabled(): Collection
    {
        return Subscription::query()
            ->when(request()->filled('for_store'), function ($query) {
                return $query->whereIn('type', ['store', 'restaurant_store']);
            })
            ->when(request()->filled('for_restaurant'), function ($query) {
                return $query->whereIn('type', ['restaurant', 'restaurant_store']);
            })
            ->where('status', 1)->latest()->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Subscription::query()->create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'subscription_type' => $request->subscription_type,
                'subscription_period' => $request->subscription_period,
                'points' => $request->points,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $subscription = $this->findById($id);

            $subscription->update([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'subscription_type' => $request->subscription_type,
                'subscription_period' => $request->subscription_period,
                'points' => $request->points,
            ]);

            return $subscription;
        });
    }

    public function findById($id, $checkStatus = false): Subscription
    {
        if ($checkStatus) {
            return Subscription::query()->where('status', 1)->findOrFail($id);
        }

        return Subscription::query()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $subscription = $this->findById($id);

            $subscription->delete();
        });
    }

    public function subscribeSeller($seller_id, $subscription_id)
    {
        $seller = Seller::query()->find($seller_id);

        $subscription = $this->findById($subscription_id, true);

        $date = self::getPlanExpiredAt($subscription);

        if ($seller->is_subscribe_to_free_subscription && $subscription->is_free_subscription) {
            throw new Exception(__('You subscribe to free plan before, please subscribe to paid subscription'));
        }

        $subscriptionPoints = $subscription->points;

        $sellerCurrentPoints = $seller->current_points;

        if ($subscriptionPoints > $sellerCurrentPoints) {
            throw new Exception(__('Your points is not enough to subscribe to subscription'), Response::HTTP_PAYMENT_REQUIRED);
        }

        if ($subscription->is_free_subscription) {
            $seller->update([
                'is_subscribe_to_free_subscription' => 1,
            ]);
        }

        if ($subscriptionPoints) {
            $seller->paySubscriptionPlan($subscriptionPoints);
        }

        $date = self::getPlanExpiredAt($subscription);

        $seller->update([

            'plan_expired_at' => $date->format('Y-m-d'),

            'two_days_before_plan_expiration' => $date->subDays(2)->format('Y-m-d'),
            'one_days_before_plan_expiration' => $date->subDay()->format('Y-m-d'),

            'seller_notified_before_two_days' => false,
            'seller_notified_before_one_days' => false,
            'seller_notified_in_expiration_date' => false,
        ]);

        $seller->notify(new SellerSubscriptionNotification($subscription, now()->diffInDays($date)));
    }

    private static function getPlanExpiredAt(Subscription $subscription)
    {
        $date = Carbon::now();
        $expiryDate = Auth::user()->plan_expired_at;
        if ($expiryDate) {
            if (Carbon::parse($expiryDate)->gt(now())) {
                $date = Carbon::parse($expiryDate);
            }
        }
        if ($subscription->subscription_type == 'months') {
            return $date->addMonths($subscription->subscription_period);
        }
        if ($subscription->subscription_type == 'days') {
            return $date->addDays($subscription->subscription_period);
        }
        if ($subscription->subscription_type == 'years') {
            return $date->addYears($subscription->subscription_period);
        }
    }
}
