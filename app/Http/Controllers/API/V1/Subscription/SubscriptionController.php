<?php

namespace App\Http\Controllers\API\V1\Subscription;

use App\Http\Controllers\Controller;
use App\Services\Subscription\SubscriptionServices;
use App\Http\Resources\Subscription\SubscriptionResource;

class SubscriptionController extends Controller
{
    public function __construct(private SubscriptionServices $subscriptionServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(SubscriptionResource::collection($this->subscriptionServices->getEnabled()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(SubscriptionResource::make($this->subscriptionServices->findById($id, true)));
    }
}
