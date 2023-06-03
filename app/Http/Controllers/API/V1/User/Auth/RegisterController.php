<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\User\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = $request->register();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        $data = [
            'redirect' => 'login_screen',
        ];

        return $this::sendSuccessResponse($data);
    }
}
