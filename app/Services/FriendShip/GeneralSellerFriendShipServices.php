<?php

namespace App\Services\FriendShip;

use Exception;
use App\Models\Seller;
use App\Models\FriendRequest;
use App\Enums\FriedRequestEnum;
use App\Models\SellerFriendRequest;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\User\SellerAcceptFriendShipRequestNotification;

class GeneralSellerFriendShipServices
{
    public function getFriendRequests(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return SellerFriendRequest::query()->where('store_seller_id', $seller->id)->where('friend_request_accepted_from_seller', 0)->latest()->get();
    }

    public function getFriends(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return SellerFriendRequest::query()
            ->where('store_seller_id', $seller->id)
            ->where('friend_request_accepted_from_seller', 1)
            ->when(request()->filled('friendship_type') && request()->friendship_type == FriedRequestEnum::SPECIAL->name, function ($query) {
                $query->where('friendship_type', FriedRequestEnum::SPECIAL->name);
            })
            ->latest()
            ->get();
    }

    public function acceptFriendRequest($seller_id): void
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $friendRequest = SellerFriendRequest::query()->where('seller_id', $seller_id)->where('store_seller_id', $seller->id)->first();

        if (is_null($friendRequest)) {
            throw new Exception(__('there is no request from user'));
        }

        if ($friendRequest->friend_request_accepted_from_seller) {
            throw new Exception(__('You already accepted request before'));
        }

        $friendRequest->update([
            'friend_request_accepted_from_seller' => 1,
        ]);

        $this->sendAcceptanceNotification($friendRequest);
    }

    public function makeFriendSpecial($seller_id): void
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $friendRequest = SellerFriendRequest::query()->where('seller_id', $seller_id)->where('store_seller_id', $seller->id)->first();

        if (is_null($friendRequest)) {
            throw new Exception(__('there is no request from user'));
        }

        if ($friendRequest->friend_request_accepted_from_seller == 0) {
            throw new Exception(__('You should first accepted request'));
        }

        $friendRequest->update([
            'friendship_type' => FriedRequestEnum::SPECIAL->name,
        ]);
    }

    public function rejectFriendRequest($seller_id): void
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $friendRequest = SellerFriendRequest::query()->where('seller_id', $seller_id)->where('store_seller_id', $seller->id)->first();

        if (is_null($friendRequest)) {
            throw new Exception(__('there is no request from user'));
        }

        $friendRequest->delete();
    }

    private function sendAcceptanceNotification(SellerFriendRequest $friendRequest): void
    {
        $friendRequest->seller->notify(new SellerAcceptFriendShipRequestNotification($friendRequest->seller));
    }

    public function getCountFriends()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return SellerFriendRequest::query()
            ->where('store_seller_id', $seller->id)
            ->where('friend_request_accepted_from_seller', 1)
            ->when(request()->filled('friendship_type') && request()->friendship_type == FriedRequestEnum::SPECIAL->name, function ($query) {
                $query->where('friendship_type', FriedRequestEnum::SPECIAL->name);
            })->count();
    }

    public function getCountFriendRequests()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return SellerFriendRequest::query()->where('seller_id', $seller->id)->where('friend_request_accepted_from_seller', 0)->count();
    }
}
