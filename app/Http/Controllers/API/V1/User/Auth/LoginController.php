<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserAuthServices;
use App\Http\Requests\API\Auth\User\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private UserAuthServices $userAuthServices)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        $user = $request->authenticate();

        $this->userAuthServices->generateOtp($user);

        return $this::sendSuccessResponse([], __('Otp Send Successfully'));
    }
}
