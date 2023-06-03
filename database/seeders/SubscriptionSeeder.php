<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $subscriptions = [
            [
                'title' => [
                    'ar' => 'الباقة الاولي',
                    'en' => 'First Subscription Plan',
                ],
                'description' => [
                    'ar' => 'تفاصيل الباقة الاولي',
                    'en' => 'First Subscription Plan Details',
                ],
                'subscription_type' => 'months',
                'subscription_period' => 1,
                'is_free_subscription' => 1,
            ],
            [
                'title' => [
                    'ar' => 'الباقة الثانية',
                    'en' => 'Second Subscription Plan',
                ],
                'description' => [
                    'ar' => 'تفاصيل الباقة الثانية',
                    'en' => 'Second Subscription Plan Details',
                ],
                'subscription_type' => 'months',
                'subscription_period' => 2,
                'points' => 200,
                'is_free_subscription' => 0,
            ],
            [
                'title' => [
                    'ar' => 'الباقة الثالثة',
                    'en' => 'Third Subscription Plan',
                ],
                'description' => [
                    'ar' => 'تفاصيل الباقة الثالثة',
                    'en' => 'Third Subscription Plan Details',
                ],
                'subscription_type' => 'months',
                'subscription_period' => 6,
                'points' => 600,
                'is_free_subscription' => 0,
            ],
            [
                'title' => [
                    'ar' => 'الباقة الرابعة',
                    'en' => 'Fourth Subscription Plan',
                ],
                'description' => [
                    'ar' => 'تفاصيل الباقة الرابعة',
                    'en' => 'Fourth Subscription Plan Details',
                ],
                'subscription_type' => 'months',
                'subscription_period' => 12,
                'points' => 1000,
                'is_free_subscription' => 0,
            ],
        ];
        foreach ($subscriptions as $subscription) {
            Subscription::query()->create([
                'title' => $subscription['title'],
                'description' => $subscription['description'],
                'subscription_type' => $subscription['subscription_type'],
                'subscription_period' => $subscription['subscription_period'],
                'points' => $subscription['points'] ?? null,
                'is_free_subscription' => $subscription['is_free_subscription'] ?? 0,
            ]);
        }
    }
}
