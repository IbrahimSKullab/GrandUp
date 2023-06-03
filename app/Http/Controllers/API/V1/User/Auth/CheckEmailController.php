<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserAuthServices;

class CheckEmailController extends Controller
{
    public function __construct(private readonly UserAuthServices $authServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
        ]);

        return $this::sendSuccessResponse([
            'email_exists' => $this->authServices->checkEmailIfExists($request->email),
        ]);
    }
}
