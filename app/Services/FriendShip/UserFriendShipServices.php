<?php

namespace App\Services\FriendShip;

use Auth;
use Exception;
use App\Models\Seller;
use App\Models\FriendRequest;
use App\Notifications\Seller\NewFriendShipRequestNotification;

class UserFriendShipServices
{
    public function sendFriendShipRequest($seller_id): void
    {
        $friendRequest = FriendRequest::query()->where('seller_id', $seller_id)->where('user_id', Auth::id())->first();

        if (! is_null($friendRequest) && $friendRequest?->friend_request_accepted_from_seller) {
            throw new Exception(__('You already friends'));
        }

        if (! is_null($friendRequest) && $friendRequest?->friend_request_accepted_from_seller == 0) {
            throw new Exception(__('You send request to seller before, but seller not accepted yet'));
        }

        $this->sendFriendRequestNotification($seller_id);

        FriendRequest::query()->create([
            'user_id' => Auth::id(),
            'seller_id' => $seller_id,
            'friend_request_accepted_from_seller' => 0,
        ]);

        $seller = Seller::query()->find($seller_id);

        $seller->notify(new NewFriendShipRequestNotification($seller));
    }

    public function unFriendRequest($seller_id): void
    {
        $friendRequest = FriendRequest::query()->where('seller_id', $seller_id)->where('user_id', Auth::id())->first();

        if (is_null($friendRequest)) {
            throw new Exception(__('You are not friends'));
        }

        $friendRequest->delete();
    }

    private function sendFriendRequestNotification($seller_id)
    {
    }
}
