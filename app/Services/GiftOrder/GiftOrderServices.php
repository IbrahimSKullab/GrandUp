<?php

namespace App\Services\GiftOrder;

use Exception;
use App\Models\Gift;
use App\Models\User;
use App\Models\Admin;
use App\Models\GiftOrder;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\Admin\GiftOrderNotification;
use App\Notifications\User\GiftOrderApprovedNotification;
use App\Notifications\User\GiftOrderRejectedNotification;
use Illuminate\Support\Facades\DB;

class GiftOrderServices implements ServiceInterface
{
    public function get(): Collection
    {
        return GiftOrder::query()->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return GiftOrder::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::query()->find($request->user_id);

            $userCurrentPoints = $user->current_points;

            $totalPoints = $this->getTotalPoints($request->gifts);

            $totalQty = $this->getTotalQty($request->gifts);

            if ($totalPoints > $userCurrentPoints) {
                throw new Exception(__('Your current points are not enough to take theses gifts'));
            }

            $giftOrder = GiftOrder::query()->create([
                'user_id' => $user->id,
                'total_points' => $totalPoints,
                'total_qty' => $totalQty,
            ]);

            $giftOrder->update([
                'order_code' => '000' . $giftOrder->id,
            ]);

            $giftOrder->refresh();

            foreach ($request->gifts as $reqGift) {
                $gift = Gift::query()->find($reqGift['gift_id']);

                $giftOrder->items()->create([
                    'user_id' => $user->id,
                    'gift_id' => $gift->id,
                    'points' => $gift->points,
                    'qty' => $reqGift['qty'],
                ]);
            }

            $user->update([
                'current_points' => $userCurrentPoints - $totalPoints,
            ]);

            $giftOrder->refresh();

            $admins = Admin::query()->where('status', 1)->where('is_staff', 1)->get();

            foreach ($admins as $admin) {
                if ($admin->hasPermissionTo('gift_orders')) {
                    $admin->notify(new GiftOrderNotification($giftOrder));
                }
            }
        });
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    private function getTotalPoints($gifts): int
    {
        $points = 0;
        foreach ($gifts as $reqGift) {
            $points += (int)Gift::query()->find($reqGift['gift_id'])->points * $reqGift['qty'];
        }

        return $points;
    }

    private function getTotalQty($gifts): int
    {
        $qty = 0;
        foreach ($gifts as $reqGift) {
            $qty += $reqGift['qty'];
        }

        return $qty;
    }

    public function updateStatus($status, $id)
    {
        return DB::transaction(function () use ($status, $id) {
            $giftOrder = $this->findById($id);

            if ($giftOrder->status == 'completed') {
                throw new Exception(__('Cannot change order status because order is already completed'));
            }

            if ($giftOrder->status == 'rejected') {
                throw new Exception(__('Cannot change order status because order is already rejected'));
            }

            $giftOrder->update([
                'status' => $status,
            ]);

            if ($status == 'rejected') {
                $userCurrentPoints = $giftOrder->user->current_points;
                $giftOrder->user->update([
                    'current_points' => $userCurrentPoints + $giftOrder->points,
                ]);
                $giftOrder->user->notify(new GiftOrderRejectedNotification($giftOrder));
            }

            if ($status == 'completed') {
                $giftOrder->user->storeGiftOrderTransaction($giftOrder->total_points);

                $giftOrder->user->notify(new GiftOrderApprovedNotification($giftOrder));
            }
        });
    }
}
