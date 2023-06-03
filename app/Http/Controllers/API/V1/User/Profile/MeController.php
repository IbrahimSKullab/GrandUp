<?php

namespace App\Http\Controllers\API\V1\User\Profile;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;

class MeController extends Controller
{
    public function __invoke()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->withCount(['orders', 'friends'])->first();

        return $this::sendSuccessResponse(UserResource::make($user));
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this::sendSuccessResponse([], __('User Logout Successfully'));
    }
}
