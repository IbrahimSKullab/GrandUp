<?php

namespace App\Http\Controllers\API\V1\Seller\PayCard;

use App\Services\Card\CardServices;
use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ChargingCard\ChargingCardServices;

class PayCardController extends Controller
{
    public function __construct(private CardServices $cardServices)
    {
    }

    public function charge(Request $request, $id)
    {
//        $this->validate($request, [
//            'card_number' => 'required|string|max:16|min:16|exists:charging_cards,card_number',
//        ], [
//            'card_number.exists' => __('Card number not found'),
//        ]);

        try {
            $this->cardServices->payCard(Auth::id(), $id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(__('Seller Charging Successfully'));
    }
}
