<?php

namespace App\Http\Controllers\Seller\Notification;

use Auth;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->unreadNotifications()->latest()->take(10)->get();

        return view('global-partials.notifications')->with([
            'notifications' => $notifications,
        ]);
    }

    public function update($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        $notification->markAsRead();

        return $this::sendSuccessResponse([
            'remaining_notification' => Auth::user()->unreadNotifications()->count(),
        ]);
    }
}
