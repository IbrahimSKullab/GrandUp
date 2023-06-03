<?php

namespace App\Http\Controllers\API\V1\User\ChargingCard;

use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChargingCard\ChargingCardServices;

class ChargingCardController extends Controller
{
    public function __construct(private ChargingCardServices $chargingCardServices)
    {
    }

    public function charge(Request $request)
    {
        $this->validate($request, [
            'card_number' => 'required|string|max:16|min:16|exists:charging_cards,card_number',
        ], [
            'card_number.exists' => __('Card number not found'),
        ]);

        try {
            $this->chargingCardServices->chargeUserWithCardPoints(Auth::id(), $request->card_number);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(__('User Charging Successfully'));
    }
}
