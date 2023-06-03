<?php

namespace App\Services\Transaction;

use Exception;
use App\Models\Card;
use App\Models\User;
use App\Models\Admin;
use App\Helper\Helper;
use App\Models\Seller;
use Illuminate\Support\Str;
use App\Models\ChargingCard;
use App\Enums\TransactionEnum;
use App\Models\PosTransaction;
use App\Models\UserTransaction;
use App\Models\AgentTransaction;
use App\Models\SellerTransaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TransactionServices
{
    public function findTransactionForPos($pos_id, $id): PosTransaction
    {
        return PosTransaction::query()->where('pos_id', $pos_id)->findOrFail($id);
    }

    public function findTransactionForAgent($agent_id, $id): AgentTransaction
    {
        return AgentTransaction::query()->where('agent_id', $agent_id)->findOrFail($id);
    }

    public function getUserTransactions($user_id): Collection
    {
        return UserTransaction::query()->where('user_id', $user_id)->latest()->get();
    }

    public function getUserTransactionsCount($user_id): int
    {
        return UserTransaction::query()->where('user_id', $user_id)->count();
    }

    public function findUserTransaction($user_id, $transaction_id): UserTransaction
    {
        return UserTransaction::query()->where('user_id', $user_id)->findOrFail($transaction_id);
    }

    public function getSellerTransactions($seller_id): Collection
    {
        return SellerTransaction::query()->where('seller_id', $seller_id)->latest()->get();
    }

    public function getSellerTransactionsCount($seller_id): int
    {
        return SellerTransaction::query()->where('seller_id', $seller_id)->count();
    }

    public function findSellerTransaction($seller_id, $transaction_id): SellerTransaction
    {
        return SellerTransaction::query()->where('seller_id', $seller_id)->findOrFail($transaction_id);
    }

    public function creditPointsToUser($user_id, $points, $card_number = null, $admin_id = null): void
    {
        $user = $this->findUser($user_id);
        $user->creditUserPointBy($points, $admin_id, $card_number);
    }

    public function findUser($user_id): User
    {
        return User::query()->findOrFail($user_id);
    }

    public function creditPointsToSeller($seller_id, $points, $card_number = null, $admin_id = null): void
    {
        $seller = $this->findSeller($seller_id);
        $seller->creditSellerPointBy($points, $admin_id, $card_number);
    }

    public function findSeller($seller_id): Seller
    {
        return Seller::query()->findOrFail($seller_id);
    }

    public function creditPointsToPOS($pos_id, $points, $admin_id = null): void
    {
        $pos = $this->findPos($pos_id);
        $pos->creditPOSPointBy($points, $admin_id);
    }

    public function findPos($pos_id): Admin
    {
        return Admin::query()
            ->where('is_pos', 1)
            ->where('is_agent', 0)
            ->where('is_staff', 0)
            ->findOrFail($pos_id);
    }

    public function creditPointsToAgent($agent_id, $points, $admin_id = null): void
    {
        $pos = $this->findAgent($agent_id);
        $pos->creditAgentPointBy($points, $admin_id);
    }

    public function findAgent($agent_id): Admin
    {
        return Admin::query()
            ->where('is_pos', 0)
            ->where('is_agent', 1)
            ->where('is_staff', 0)
            ->findOrFail($agent_id);
    }

    public function creditPointsToUserByUsingPosPoints($pos_id, $points, $user_id): void
    {
        $user = $this->findUser($user_id);
        $user->creditUserPointByUsingPosPoints($points, $pos_id);
    }

    public function creditPointsToSellerByUsingPosPoints($pos_id, $points, $seller_id): void
    {
        $seller = $this->findSeller($seller_id);
        $seller->creditSellerPointByUsingPosPoints($points, $pos_id);
    }

    public function creditPointsToPOSByUsingAgentPoints($agent_id, $points, $pos_id): void
    {
        $pos = $this->findPos($pos_id);
        $pos->creditPosPointByUsingAgentPoints($points, $agent_id);
    }

    public function creditPointsToSellerByUsingAgentPoints($agent_id, $points, $seller_id): void
    {
        $seller = $this->findSeller($seller_id);
        $seller->creditSellerPointByUsingAgentPoints($points, $agent_id);
    }

    public function creditPointsToUserByUsingAgentPoints($agent_id, $points, $user_id): void
    {
        $user = $this->findUser($user_id);
        $user->creditUserPointByUsingAgentPoints($points, $agent_id);
    }

    public function createCardsForPos($pos_id, $card_id, $count)
    {
        return DB::transaction(function () use ($pos_id, $card_id, $count) {
            $pos = Admin::query()->find($pos_id);

            $card = Card::query()->find($card_id);

            $chargingCards = new Collection();

            $totalPoints = $card->points * $count;

            if ($totalPoints > $pos->pos_current_points) {
                throw new Exception(__('Your Balance is not enough to create this type of cards'));
            }

            $random = Str::random(10);

            $pos->posTransaction()->create([
                'admin_id' => $pos_id,
                'txn_id' => $random,
                'points' => $card->points,
                'quantity' => $count,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::POS_CREATING_CARDS->name,
            ]);

            foreach (range(1, $count) as $i) {
                $chargingCard = ChargingCard::query()->create([
                    'pos_id' => $pos->id,
                    'card_number' => Helper::randomNDigitNumber(),
                    'points' => $card->points,
                    'is_used' => 0,
                    'transaction_id' => $random,
                    'price' => $card->card_price,
                ]);

                $chargingCards->push($chargingCard);
            }

            $posCurrentPoint = $pos->pos_current_points ?? 0;

            $pos->update([
                'pos_current_points' => $posCurrentPoint - $totalPoints,
            ]);

            return $chargingCards;
        });
    }

    public function createCardsForAgents($agent_id, $card_id, $count)
    {
        return DB::transaction(function () use ($agent_id, $card_id, $count) {
            $agent = Admin::query()->find($agent_id);

            $card = Card::query()->find($card_id);

            $totalPoints = $card->points * $count;

            if ($totalPoints > $agent->agent_current_points) {
                throw new Exception(__('Your Balance is not enough to create this type of cards'));
            }

            foreach (range(1, $count) as $i) {
                $random = Str::random(10);
                $agent->agentTransaction()->create([
                    'admin_id' => $agent_id,
                    'txn_id' => $random,
                    'points' => $card->points,
                    'is_added_points' => 0,
                    'transaction_type' => TransactionEnum::AGENT_CREATING_CARDS->name,
                ]);
                $cardNumber = Helper::randomNDigitNumber();
                ChargingCard::query()->create([
                    'agent_id' => $agent->id,
                    'card_number' => $cardNumber,
                    'points' => $card->points,
                    'is_used' => 0,
                    'transaction_id' => $random,
                    'price' => $card->card_price,
                ]);
            }

            $agentCurrentPoint = $agent->agent_current_points ?? 0;

            $agent->update([
                'agent_current_points' => $agentCurrentPoint - $totalPoints,
            ]);
        });
    }

    public function createCardsForAdmins($admin_id, $card_id, $count)
    {
        return DB::transaction(function () use ($admin_id, $card_id, $count) {
            $admin = Admin::query()->find($admin_id);
            $card = Card::query()->find($card_id);
            foreach (range(1, $count) as $i) {
                $random = Str::random(10);
                $cardNumber = Helper::randomNDigitNumber();
                ChargingCard::query()->create([
                    'admin_id' => $admin->id,
                    'card_number' => $cardNumber,
                    'points' => $card->points,
                    'is_used' => 0,
                    'transaction_id' => $random,
                    'price' => $card->card_price,
                ]);
            }
        });
    }

    public function getShippingTransactions($shipping_company_id): Collection
    {
        return ShippingTransaction::query()->where('shipping_company_id', $shipping_company_id)->latest()->get();
    }

    public function getShippingTransactionsCount($shipping_company_id): int
    {
        return ShippingTransaction::query()->where('shipping_company_id', $shipping_company_id)->count();
    }

    public function findShippingTransaction($shipping_company_id, $transaction_id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        return ShippingTransaction::query()->where('shipping_company_id', $shipping_company_id)->findOrFail($transaction_id);
    }
}
