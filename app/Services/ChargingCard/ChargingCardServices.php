<?php

namespace App\Services\ChargingCard;

use Exception;
use App\Models\User;
use App\Models\Seller;
use App\Models\ChargingCard;

class ChargingCardServices
{
    public function chargeUserWithCardPoints($user_id, $card_number): void
    {
        $user = User::query()->find($user_id);

        $card = ChargingCard::query()->where('card_number', $card_number)->first();

        $this->checkTheValidityOfCard($card);

        $user->creditUserByChargingCard($card);
    }

    public function chargeSellerWithCardPoints($seller_id, $card_number): void
    {
        $seller = Seller::query()->find($seller_id);

        $card = ChargingCard::query()->where('card_number', $card_number)->first();

        $this->checkTheValidityOfCard($card);

        $seller->creditSellerByChargingCard($card);
    }

    public function checkTheValidityOfCard($card): void
    {
        if ($card->is_used) {
            throw new Exception(__('Card is already used'));
        }
    }
}
