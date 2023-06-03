<?php

namespace App\Http\Controllers\API\V1\Seller\ChargingCard;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $this->chargingCardServices->chargeSellerWithCardPoints(Auth::id(), $request->card_number);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(__('Seller Charging Successfully'));
    }
}
