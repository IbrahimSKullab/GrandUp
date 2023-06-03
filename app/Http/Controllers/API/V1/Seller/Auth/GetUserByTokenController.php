<?php

namespace App\Http\Controllers\API\V1\Seller\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerAuthServices;

class GetUserByTokenController extends Controller
{
    public function __construct(private readonly SellerAuthServices $sellerAuthServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'access_token' => 'required|string',
            'device_token' => 'nullable|string',
        ]);

        try {
            $seller = $this->sellerAuthServices->getUserByToken($request->access_token, $request->device_token);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($seller->getAuthResource());
    }
}
