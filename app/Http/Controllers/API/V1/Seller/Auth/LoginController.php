<?php

namespace App\Http\Controllers\API\V1\Seller\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerAuthServices;
use App\Http\Requests\API\Auth\Seller\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private readonly SellerAuthServices $sellerAuthServices)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $user = $request->authenticate();

            $this->sellerAuthServices->generateOtp($user);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Otp Send Successfully'));
    }
}
