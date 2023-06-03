<?php

namespace App\Http\Controllers\API\V1\Seller\Profile;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class DeleteAccountController extends Controller
{
    public function __invoke()
    {
        $userId = Auth::id();

        Auth::user()->tokens()->delete();

        User::query()->where('id', $userId)->delete();

        return $this::sendSuccessResponse([], __('Account Deleted Successfully'));
    }
}
