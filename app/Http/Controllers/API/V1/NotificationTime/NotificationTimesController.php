<?php

namespace App\Http\Controllers\API\V1\NotificationTime;

use App\Http\Controllers\Controller;
use App\Services\NotificationTime\NotificationTimeServices;
use App\Http\Resources\NotificationTime\NotificationTimeResource;

class NotificationTimesController extends Controller
{
    public function __construct(private readonly NotificationTimeServices $notificationTimeServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse([
            'count' => $this->notificationTimeServices->count(),
            'data' => NotificationTimeResource::collection($this->notificationTimeServices->get()),
        ]);
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(NotificationTimeResource::make($this->notificationTimeServices->findById($id, true)));
    }
}
