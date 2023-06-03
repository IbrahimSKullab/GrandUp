<?php

namespace App\Http\Controllers\API\V1\Pos\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Pos\PosAuthServices;

class VerifyOtpController extends Controller
{
    public function __construct(private readonly PosAuthServices $posAuthServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string',
            'otp_code' => 'required|string',
        ]);

        try {
            $user = $this->posAuthServices->verifyOtp($request->phone, $request->otp_code);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($user->getAuthResource());
    }
}
