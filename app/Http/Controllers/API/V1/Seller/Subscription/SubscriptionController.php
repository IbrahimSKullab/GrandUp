<?php

namespace App\Http\Controllers\API\V1\Seller\Subscription;

use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\Subscription\SubscriptionServices;

class SubscriptionController extends Controller
{
    public function __construct(private readonly SubscriptionServices $subscriptionServices)
    {
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'subscription_id' => [
                'required',
                Rule::exists('subscriptions', 'id')->where('status', 1),
            ],
        ]);

        try {
            $this->subscriptionServices->subscribeSeller(Auth::id(), $request->subscription_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Seller Subscribed Successfully'));
    }
}
