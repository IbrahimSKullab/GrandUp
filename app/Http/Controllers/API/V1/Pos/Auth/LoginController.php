<?php

namespace App\Http\Controllers\API\V1\Pos\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Pos\PosAuthServices;
use App\Http\Requests\API\Auth\Pos\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private PosAuthServices $posAuthServices)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $user = $request->authenticate();

            $this->posAuthServices->generateOtp($user);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Otp Send Successfully'));
    }
}
