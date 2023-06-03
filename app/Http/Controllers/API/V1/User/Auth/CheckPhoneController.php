<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserAuthServices;

class CheckPhoneController extends Controller
{
    public function __construct(private UserAuthServices $authServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string',
        ]);

        return $this::sendSuccessResponse([
            'phone_exists' => $this->authServices->checkPhoneIfExists($request->phone),
        ]);
    }
}
