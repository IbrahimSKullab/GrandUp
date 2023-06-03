<?php

namespace App\Http\Controllers\API\V1\User\Profile;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
