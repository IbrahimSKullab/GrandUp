<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Admin\AdminResource;

class ProfileController extends Controller
{
    public function me()
    {
        return $this::sendSuccessResponse(AdminResource::make(Auth::user()));
    }
}
