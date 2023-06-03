<?php

namespace App\Http\Controllers\API\V1\Seller\Profile;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\SellerResource;

class MeController extends Controller
{
    public function __invoke()
    {
        return $this::sendSuccessResponse(SellerResource::make(Auth::user()));
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this::sendSuccessResponse([], __('Seller Logout Successfully'));
    }
}
