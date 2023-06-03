<?php

namespace App\Http\Controllers\API\V1\Seller\FriendShip;

use App\Http\Resources\FriendRequest\GeneralFriendRequestResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\FriendShip\SellerFriendShipServices;
use App\Http\Resources\FriendRequest\FriendRequestResource;

class FriendShipRequestController extends Controller
{
    public function __construct(
        private SellerFriendShipServices $sellerFriendShipServices,
    ) {
    }

    public function getFriendRequests()
    {
        $requests = $this->sellerFriendShipServices->getFriendRequests();

        return $this::sendSuccessResponse(FriendRequestResource::collection($requests));
    }

    public function getFriends()
    {
        $requests = $this->sellerFriendShipServices->getFriends();

        return $this::sendSuccessResponse(FriendRequestResource::collection($requests));
    }

    public function acceptFriendRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $this->sellerFriendShipServices->acceptFriendRequest($request->user_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Accepted Successfully'));
    }

    public function makeFriendSpecial(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $this->sellerFriendShipServices->makeFriendSpecial($request->user_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Mark As Special Successfully'));
    }

    public function rejectFriendRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $this->sellerFriendShipServices->rejectFriendRequest($request->user_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Rejected Successfully'));
    }

    public function sendFriendShip(Request $request)
    {
        $this->validate($request, [
            'store_seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->sellerFriendShipServices->sendFriendShipRequest($request->store_seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Send Successfully'));
    }

    public function unFriendRequest(Request $request)
    {

        $this->validate($request, [
            'store_seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->sellerFriendShipServices->unFriendRequest($request->store_seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('UnFriend Request Send Successfully'));
    }

    public function getFriendsStore()
    {
        $requests = $this->sellerFriendShipServices->getFriendsStore();

        return $this::sendSuccessResponse(GeneralFriendRequestResource::collection($requests));
    }
}
