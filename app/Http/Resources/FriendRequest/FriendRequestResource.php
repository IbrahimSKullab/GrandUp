<?php

namespace App\Http\Resources\FriendRequest;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserPublicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendRequestResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserPublicResource::make($this->user),
            'friendship_type' => $this->friendship_type,
            'friend_request_accepted_from_seller' => $this->friend_request_accepted_from_seller,
            'created_at' => Helper::formatDate($this->created_at),
        ];
    }
}
