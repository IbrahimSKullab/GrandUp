<?php

namespace App\Http\Controllers\API\V1\Seller\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\Seller\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $request->register();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Your request has been sent to the administration, and it will be reviewed by the administration and contacted with you'));
    }
}
