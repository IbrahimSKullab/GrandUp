<?php

namespace App\Http\Controllers\API\V1\Card;

use App\Services\Card\CardServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\Card\CardResource;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct(private CardServices $cardServices)
    {
    }

    public function index()
    {

        return $this::sendSuccessResponse(CardResource::collection($this->cardServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(CardResource::make($this->cardServices->findById($id, true)));
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
