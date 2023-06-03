<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return $this::sendSuccessResponse([], __('Password Updated'));
    }
}
