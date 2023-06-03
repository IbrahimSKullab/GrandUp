<?php

namespace App\Http\Controllers\API\V1\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Requests\API\Admin\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $admin = $request->authenticate();
        $admin->tokens()->delete();
        $data = [
            'access_token' => $admin->createToken(Str::random(10))->plainTextToken,
            'admin' => AdminResource::make($admin),
        ];

        return $this::sendSuccessResponse($data);
    }
}
