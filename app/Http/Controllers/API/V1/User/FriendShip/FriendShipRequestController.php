<?php

namespace App\Http\Controllers\API\V1\User\FriendShip;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FriendShip\UserFriendShipServices;
use Illuminate\Support\Facades\Log;

class FriendShipRequestController extends Controller
{
    public function __construct(private UserFriendShipServices $userFriendShipServices)
    {
    }

    public function sendFriendShipRequest(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->userFriendShipServices->sendFriendShipRequest($request->seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Friend Request Send Successfully'));
    }

    public function unFriendRequest(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);

        try {
            $this->userFriendShipServices->unFriendRequest($request->seller_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('UnFriend Request Send Successfully'));
    }
}
