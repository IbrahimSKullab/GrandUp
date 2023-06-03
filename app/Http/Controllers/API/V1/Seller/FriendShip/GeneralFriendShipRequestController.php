<?php

namespace App\Http\Controllers\API\V1\Seller\FriendShip;

use App\Services\FriendShip\GeneralSellerFriendShipServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\FriendRequest\GeneralFriendRequestResource;

class GeneralFriendShipRequestController extends Controller
{
    public function __construct(
        private GeneralSellerFriendShipServices $sellerFriendShipServices,
    ) {
    }

    public function getFriendRequests()
    {
        $requests = $this->sellerFriendShipServices->getFriendRequests();

        return $this::sendSuccessResponse(GeneralFriendRequestResource::collection($requests));
    }

    public function getFriends()
    {
        $requests = $this->sellerFriendShipServices->getFriends();

        return $this::sendSuccessResponse(GeneralFriendRequestResource::collection($requests));
    }

    public function acceptFriendRequest(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->sellerFriendShipServices->acceptFriendRequest($request->seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Accepted Successfully'));
    }

    public function makeFriendSpecial(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->sellerFriendShipServices->makeFriendSpecial($request->seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Mark As Special Successfully'));
    }

    public function rejectFriendRequest(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->sellerFriendShipServices->rejectFriendRequest($request->seller_id);
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
}
