<?php

namespace App\Http\Resources\FriendRequest;

use App\Helper\Helper;
use App\Http\Resources\Seller\SellerPublicResource;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserPublicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralFriendRequestResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller' => SellerPublicResource::make($this->seller),
            'store_seller' => SellerPublicResource::make($this->storeSeller),
            'friendship_type' => $this->friendship_type,
            'friend_request_accepted_from_seller' => $this->friend_request_accepted_from_seller,
            'created_at' => Helper::formatDate($this->created_at),
        ];
    }
}
