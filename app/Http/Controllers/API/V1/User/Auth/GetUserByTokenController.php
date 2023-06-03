<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserAuthServices;

class GetUserByTokenController extends Controller
{
    public function __construct(private readonly UserAuthServices $userAuthServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'access_token' => 'required|string',
            'device_token' => 'nullable|string',
        ]);

        try {
            $user = $this->userAuthServices->getUserByToken($request->access_token, $request->device_token);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($user->getAuthResource());
    }
}
