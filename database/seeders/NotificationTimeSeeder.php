<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTimes;

class NotificationTimeSeeder extends Seeder
{
    public function run()
    {
        NotificationTimes::query()->create([
            'title' => [
                'ar' => 'الاشعار رقم 1',
                'en' => 'Notification Number 1',
            ],
            'description' => [
                'ar' => 'الاشعار رقم 1',
                'en' => 'Notification Number 1',
            ],
            'date' => '2023-01-01 09:00:00',
            'number_of_notifications' => 100,
            'points' => 100,
        ]);
        NotificationTimes::query()->create([
            'title' => [
                'ar' => 'الاشعار رقم 2',
                'en' => 'Notification Number 2',
            ],
            'description' => [
                'ar' => 'الاشعار رقم 2',
                'en' => 'Notification Number 2',
            ],
            'date' => '2023-01-02 09:00:00',
            'number_of_notifications' => 500,
            'points' => 500,
        ]);
        NotificationTimes::query()->create([
            'title' => [
                'ar' => 'الاشعار رقم 3',
                'en' => 'Notification Number 3',
            ],
            'description' => [
                'ar' => 'الاشعار رقم 3',
                'en' => 'Notification Number 3',
            ],
            'date' => '2023-01-03 09:00:00',
            'number_of_notifications' => 1000,
            'points' => 1000,
        ]);
    }
}
