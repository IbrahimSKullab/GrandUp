<?php

namespace App\Http\Controllers\API\V1\Notification;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Notification\NotificationServices;
use App\Http\Resources\Notification\NotificationResource;

class NotificationController extends Controller
{
    public function __construct(private NotificationServices $notificationServices)
    {
    }

    public function index()
    {
        $notifications = $this->notificationServices->get();

        return $this::sendSuccessResponse(NotificationResource::collection($notifications));
    }

    public function show($id)
    {
        $notification = $this->notificationServices->findById($id);

        return $this::sendSuccessResponse(NotificationResource::make($notification));
    }

    public function markAsRead($id)
    {
        try {
            $this->notificationServices->markAsRead($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Marked As Read'));
    }

    public function markAllAsRead()
    {
        try {
            $this->notificationServices->markAllAsRead();
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('All Marked As Read'));
    }

    public function destroy($id)
    {
        try {
            $this->notificationServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Deleted Successfully'));
    }

    public function destroyAll()
    {
        try {
            $this->notificationServices->destroyAll();
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('All Notification Deleted Successfully'));
    }
}
