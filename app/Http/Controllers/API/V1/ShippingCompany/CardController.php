<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Models\Card;
use App\Models\ChargingCard;
use App\Models\ShippingCompany;
use App\Http\Controllers\Controller;
use App\Http\Resources\Card\CardResource;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::shipping()->get();

        return $this::sendSuccessResponse(CardResource::collection($cards));
    }

    public function show($id)
    {
        $cards = Card::findOrFail($id);

        return $this::sendSuccessResponse(new CardResource($cards));
    }

    public function pay(Request $request, $id)
    {

        $shipping_company = ShippingCompany::findOrFail(auth()->user()->id);

        $card = Card::findOrFail($id);

        $shipping_company->payCardShippingCompanyTransactions($card);

        return $this::sendSuccessResponse(__('Shipping Company Charging Successfully'));
    }

    public function charging(Request $request)
    {
        $this->validate($request, [
            'card_number' => 'required|string|max:16|min:16|exists:charging_cards,card_number',
        ], [
            'card_number.exists' => __('Card number not found'),
        ]);

        $shipping_company = ShippingCompany::findOrFail(1);

        $card = ChargingCard::query()->where('card_number', $request->card_number)->first();

        if ($card->is_used) {
            throw new Exception(__('Card is already used'));
        }

        $shipping_company->creditShippingCompanyByChargingCard($card);

        return $this::sendSuccessResponse(__('Seller Charging Successfully'));
    }
}
