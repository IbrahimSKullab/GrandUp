<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserAuthServices;

class VerifyOtpController extends Controller
{
    public function __construct(private UserAuthServices $userAuthServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string',
            'otp_code' => 'required|string',
        ]);

        try {
            $user = $this->userAuthServices->verifyOtp($request->phone, $request->otp_code);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($user->getAuthResource());
    }
}
