<?php

namespace App\Traits;

use DB;
use Str;
use Auth;
use App\Models\Card;
use App\Models\Admin;
use App\Helper\Helper;
use App\Models\Seller;
use App\Models\ChargingCard;
use App\Enums\TransactionEnum;
use App\Models\PosTransaction;
use App\Models\UserTransaction;
use App\Models\AgentTransaction;
use App\Models\SellerTransaction;
use App\Notifications\ReceivedPointNotification;
use App\Notifications\DeductionPointNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HandleTransactionTrait
{
    public function creditUserPointBy($points, $admin_id = null, $card_number = null): void
    {
        DB::transaction(function () use ($points, $admin_id, $card_number) {
            $this->userTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT->name,
                'card_number' => $card_number,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'credit_by_admin' => 1,
                'point_added_by' => 'admin',
            ]);
            $userCurrentPoint = $this->current_points;
            $this->update([
                'current_points' => $userCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function userTransaction(): HasMany
    {
        return $this->hasMany(UserTransaction::class);
    }

    public function creditSellerPointBy($points, $admin_id = null, $card_number = null): void
    {
        DB::transaction(function () use ($points, $admin_id, $card_number) {
            $this->sellerTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT->name,
                'card_number' => $card_number,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'credit_by_admin' => 1,
                'point_added_by' => 'admin',
            ]);
            $sellerCurrentPoint = $this->current_points;
            $this->update([
                'current_points' => $sellerCurrentPoint + $points,
                'seller_notified_with_empty_points' => 0,
                'seller_notified_with_points_doesnot_show' => ! Helper::isSellerPointGreaterThanSetting($points),
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function sellerTransaction(): HasMany
    {
        return $this->hasMany(SellerTransaction::class);
    }

    public function creditPOSPointBy($points, $admin_id = null): void
    {
        DB::transaction(function () use ($points, $admin_id) {
            $this->posTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => Str::random(10),
                'points' => $points,
                'credit_by_admin' => 1,
                'transaction_type' => TransactionEnum::CREDIT->name,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'point_added_by' => 'admin',
            ]);
            $posCurrentPoint = $this->pos_current_points ?? 0;
            $this->update([
                'pos_current_points' => $posCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function posTransaction(): HasMany
    {
        return $this->hasMany(PosTransaction::class, 'pos_id');
    }

    public function creditAgentPointBy($points, $admin_id = null): void
    {
        DB::transaction(function () use ($points, $admin_id) {
            $this->agentTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT->name,
                'to_phone' => $this->phone,
                'credit_by_admin' => 1,
                'is_added_points' => 1,
                'point_added_by' => 'admin',
            ]);
            $agentCurrentPoint = $this->agent_current_points ?? 0;
            $this->update([
                'agent_current_points' => $agentCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function agentTransaction(): HasMany
    {
        return $this->hasMany(AgentTransaction::class, 'agent_id');
    }

    public function creditUserPointByUsingPosPoints($points, $pos_id): void
    {
        DB::transaction(function () use ($points, $pos_id) {
            $pos = Admin::query()->find($pos_id);

            $random = Str::random(10);

            $this->userTransaction()->create([
                'admin_id' => $pos_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 1,
                'point_added_by' => 'pos',
                'transaction_type' => TransactionEnum::CREDIT->name,

                'from_phone' => $pos->phone,
                'to_phone' => $this->phone,
            ]);
            $userCurrentPoint = $this->current_points ?? 0;
            $this->update([
                'current_points' => $userCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));

            $pos->posTransaction()->create([
                'admin_id' => $pos_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_USER->name,

                'from_phone' => $pos->phone,
                'to_phone' => $this->phone,
            ]);
            $posCurrentPoint = $pos->pos_current_points ?? 0;
            $pos->update([
                'pos_current_points' => $posCurrentPoint - $points,
            ]);
            $pos->notify(new DeductionPointNotification($points));
        });
    }

    public function creditSellerPointByUsingPosPoints($points, $pos_id): void
    {
        DB::transaction(function () use ($points, $pos_id) {
            $pos = Admin::query()->find($pos_id);

            $random = Str::random(10);

            $this->sellerTransaction()->create([
                'admin_id' => $pos_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 1,
                'point_added_by' => 'pos',
                'transaction_type' => TransactionEnum::CREDIT->name,

                'from_phone' => $pos->phone,
                'to_phone' => $this->phone,
            ]);
            $userCurrentPoint = $this->current_points ?? 0;
            $this->update([
                'current_points' => $userCurrentPoint + $points,
                'seller_notified_with_empty_points' => 0,
                'seller_notified_with_points_doesnot_show' => ! Helper::isSellerPointGreaterThanSetting($points),
            ]);
            $this->notify(new ReceivedPointNotification($points));

            $pos->posTransaction()->create([
                'admin_id' => $pos_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_SELLER->name,

                'from_phone' => $pos->phone,
                'to_phone' => $this->phone,
            ]);
            $posCurrentPoint = $pos->pos_current_points ?? 0;
            $pos->update([
                'pos_current_points' => $posCurrentPoint - $points,
            ]);
            $pos->notify(new DeductionPointNotification($points));
        });
    }

    public function creditPosPointByUsingAgentPoints($points, $agent_id): void
    {
        DB::transaction(function () use ($points, $agent_id) {
            $agent = Admin::query()->find($agent_id);

            $random = Str::random(10);

            $this->posTransaction()->create([
                'admin_id' => $agent->id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 1,
                'point_added_by' => 'agent',
                'transaction_type' => TransactionEnum::CREDIT->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $posCurrentPoint = $this->pos_current_points ?? 0;
            $this->update([
                'pos_current_points' => $posCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));

            $agent->agentTransaction()->create([
                'admin_id' => $agent->id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_POS->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $agentCurrentPoint = $agent->agent_current_points ?? 0;
            $agent->update([
                'agent_current_points' => $agentCurrentPoint - $points,
            ]);
            $agent->notify(new DeductionPointNotification($points));
        });
    }

    public function creditSellerPointByUsingAgentPoints($points, $agent_id): void
    {
        DB::transaction(function () use ($points, $agent_id) {
            $agent = Admin::query()->find($agent_id);

            $random = Str::random(10);

            $this->sellerTransaction()->create([
                'admin_id' => $agent_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 1,
                'point_added_by' => 'agent',
                'transaction_type' => TransactionEnum::CREDIT->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $sellerCurrentPoint = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoint + $points,
                'seller_notified_with_empty_points' => 0,
                'seller_notified_with_points_doesnot_show' => ! Helper::isSellerPointGreaterThanSetting($points),
            ]);
            $this->notify(new ReceivedPointNotification($points));

            $agent->agentTransaction()->create([
                'admin_id' => $agent_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_SELLER->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $agentCurrentPoint = $agent->agent_current_points ?? 0;
            $agent->update([
                'agent_current_points' => $agentCurrentPoint - $points,
            ]);
            $agent->notify(new DeductionPointNotification($points));
        });
    }

    public function creditUserPointByUsingAgentPoints($points, $agent_id): void
    {
        DB::transaction(function () use ($points, $agent_id) {
            $agent = Admin::query()->find($agent_id);

            $random = Str::random(10);

            $this->userTransaction()->create([
                'admin_id' => $agent_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 1,
                'point_added_by' => 'agent',
                'transaction_type' => TransactionEnum::CREDIT->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $userCurrentPoint = $this->current_points ?? 0;
            $this->update([
                'current_points' => $userCurrentPoint + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));

            $agent->agentTransaction()->create([
                'admin_id' => $agent_id,
                'txn_id' => $random,
                'points' => $points,
                'is_added_points' => 0,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_USER->name,

                'from_phone' => $agent->phone,
                'to_phone' => $this->phone,
            ]);
            $agentCurrentPoint = $agent->agent_current_points ?? 0;
            $agent->update([
                'agent_current_points' => $agentCurrentPoint - $points,
            ]);
            $agent->notify(new DeductionPointNotification($points));
        });
    }

    public function creditUserByChargingCard(ChargingCard $card)
    {
        return DB::transaction(function () use ($card) {
            $points = $card->points;

            $from_phone = null;
            $admin_id = null;

            if ($card->pos_id) {
                $from_phone = $card->pos->phone;
                $admin_id = $card->pos_id;
            }

            if ($card->agent_id) {
                $from_phone = $card->agent->phone;
                $admin_id = $card->agent_id;
            }

            if ($card->admin_id) {
                $admin_id = $card->admin_id;
            }

            $this->userTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => $card->transaction_id,
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT_USER_BY_CHARGING_CARD->name,
                'card_number' => $card->card_number,
                'from_phone' => $from_phone,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'point_added_by' => 'charging_card',
            ]);

            $card->update([
                'is_used' => 1,
                'user_id' => Auth::id(),
            ]);

            $userCurrentPoint = $this->current_points;

            $this->update([
                'current_points' => $userCurrentPoint + $points,
            ]);

            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function creditSellerByChargingCard(ChargingCard $card)
    {
        return DB::transaction(function () use ($card) {
            $points = $card->points;

            $from_phone = null;

            $admin_id = null;

            if ($card->pos_id) {
                $from_phone = $card->pos->phone;
                $admin_id = $card->pos_id;
            }

            if ($card->agent_id) {
                $from_phone = $card->agent->phone;
                $admin_id = $card->agent_id;
            }

            if ($card->admin_id) {
                $admin_id = $card->admin_id;
            }

            $this->sellerTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => $card->transaction_id,
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT_SELLER_BY_CHARGING_CARD->name,
                'card_number' => $card->card_number,
                'from_phone' => $from_phone,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'point_added_by' => 'charging_card',
            ]);

            $card->update([
                'is_used' => 1,
                'seller_id' => Auth::id(),
            ]);

            $sellerCurrentPoint = $this->current_points;

            $this->update([
                'current_points' => $sellerCurrentPoint + $points,
                'seller_notified_with_empty_points' => 0,
                'seller_notified_with_points_doesnot_show' => ! Helper::isSellerPointGreaterThanSetting($points),
            ]);

            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function creditSellerByOrderPoint($seller_id, $points)
    {
        return DB::transaction(function () use ($seller_id, $points) {
            $rand = Str::random(10);

            $seller = Seller::query()->find($seller_id);

            $this->sellerTransaction()->create([
                'txn_id' => $rand,
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT_USER_DUE_COMPLETE_ORDER->name,
                'from_phone' => $seller->phone,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'point_added_by' => 'completed_order',
            ]);

            $userCurrentPoint = $this->current_points;

            $this->update([
                'current_points' => $userCurrentPoint + $points,
            ]);

            $this->notify(new ReceivedPointNotification($points));

            $seller->sellerTransaction()->create([
                'txn_id' => $rand,
                'points' => $points,
                'transaction_type' => TransactionEnum::TRANSFER_POINTS_DUE_TO_COMPLETE_ORDER->name,
                'from_phone' => $seller->phone,
                'to_phone' => $this->phone,
                'is_added_points' => 0,
            ]);

            $seller->notify(new DeductionPointNotification($points));
        });
    }

    public function paySubscriptionPlan($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_SUBSCRIPTION->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payNotificationTimeService($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_SEND_NOTIFICATION_SERVICE->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payToAddProductToSlider($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_ADD_PRODUCT_TO_SLIDER->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payToAddProductToBlueTag($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_ADD_BLUE_TAG->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payToAddProductToOffer($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_ADD_PRODUCT_TO_OFFER->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payToUploadProduct($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::SELLER_UPLOAD_PRODUCT->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints - $points,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function storeGiftOrderTransaction($points): void
    {
        DB::transaction(function () use ($points) {
            $this->userTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::COMPLETED_GIFT_ORDER->name,
                'from_phone' => $this->phone,
                'is_added_points' => 0,
            ]);
            $this->notify(new DeductionPointNotification($points));
        });
    }

    public function payCardOrderTransactions(Card $card)
    {
        return DB::transaction(function () use ($card) {
            $points = $card->points;

            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::CARD_ORDER->name,
                'is_added_points' => 1,
                'point_added_by' => 'card_order',
            ]);

            $this->cardTransactions()->create([
                'card_id' => $card->id,
                'status' => 'PAY',
            ]);

            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function retrievePoint($points): void
    {
        DB::transaction(function () use ($points) {
            $this->sellerTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::RETRIEVE->name,
                'from_phone' => $this->phone,
                'is_added_points' => 1,
            ]);
            $sellerCurrentPoints = $this->current_points ?? 0;
            $this->update([
                'current_points' => $sellerCurrentPoints + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function payCardShippingCompanyTransactions(Card $card)
    {
        return DB::transaction(function () use ($card) {
            $points = $card->points;

            $this->shippingTransaction()->create([
                'txn_id' => Str::random(10),
                'points' => $points,
                'transaction_type' => TransactionEnum::CARD_ORDER->name,
                'is_added_points' => 1,
                'point_added_by' => 'card_order',
            ]);

            $this->cardTransactions()->create([
                'card_id' => $card->id,
                'status' => 'PAY',
            ]);

            $shipping_company_pont = $this->current_points ?? 0;
            $this->update([
                'current_points' => $shipping_company_pont + $points,
            ]);
            $this->notify(new ReceivedPointNotification($points));
        });
    }

    public function creditShippingCompanyByChargingCard(ChargingCard $card)
    {
        return DB::transaction(function () use ($card) {
            $points = $card->points;

            $from_phone = null;

            $admin_id = null;

            if ($card->pos_id) {
                $from_phone = $card->pos->phone;
                $admin_id = $card->pos_id;
            }

            if ($card->agent_id) {
                $from_phone = $card->agent->phone;
                $admin_id = $card->agent_id;
            }

            if ($card->admin_id) {
                $admin_id = $card->admin_id;
            }

            $this->shippingTransaction()->create([
                'admin_id' => $admin_id,
                'txn_id' => $card->transaction_id,
                'points' => $points,
                'transaction_type' => TransactionEnum::CREDIT_SHIPPING_COMPANY_BY_CHARGING_CARD->name,
                'card_number' => $card->card_number,
                'from_phone' => $from_phone,
                'to_phone' => $this->phone,
                'is_added_points' => 1,
                'point_added_by' => 'charging_card',
            ]);

            $card->update([
                'is_used' => 1,
                'shipping_company_id' => $this->id,
            ]);

            $shipping_company = $this->current_points;

            $this->update([
                'current_points' => $shipping_company + $points,
           ]);

            $this->notify(new ReceivedPointNotification($points));
        });
    }

}
