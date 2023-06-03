<?php

namespace App\Services\CustomNotification;

use DB;
use App\Models\User;
use App\Models\Seller;
use App\Notifications\CustomNotification;

class CustomNotificationServices
{
    public function saveNotification($request)
    {
        $notification = DB::transaction(function () use ($request) {
            $notification = \App\Models\CustomNotification::query()->create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($request->hasFile('image')) {
                $notification->addMedia($request->image)->toMediaCollection('image');
            }

            $notification->refresh();

            return $notification;
        });

        $this->send($request, $notification);
    }

    public function send($request, $notification)
    {
        if ($request->notification_for == 'all') {
            $users = User::query()->latest()->get();
            $sellers = Seller::query()->latest()->get();
            foreach ($users as $user) {
                $user->notify(new CustomNotification($notification));
            }
            foreach ($sellers as $seller) {
                $seller->notify(new CustomNotification($notification));
            }
        }
        if ($request->notification_for == 'users') {
            $users = User::query()->latest()->get();
            foreach ($users as $user) {
                $user->notify(new CustomNotification($notification));
            }
        }
        if ($request->notification_for == 'sellers') {
            $sellers = Seller::query()->latest()->get();
            foreach ($sellers as $seller) {
                $seller->notify(new CustomNotification($notification));
            }
        }
        if ($request->notification_for == 'single_user') {
            $users = User::query()->latest()->find($request->user ?? []);
            foreach ($users as $user) {
                $user->notify(new CustomNotification($notification));
            }
        }
        if ($request->notification_for == 'single_seller') {
            $sellers = User::query()->latest()->find($request->seller ?? []);
            foreach ($sellers as $seller) {
                $seller->notify(new CustomNotification($notification));
            }
        }
    }
}
