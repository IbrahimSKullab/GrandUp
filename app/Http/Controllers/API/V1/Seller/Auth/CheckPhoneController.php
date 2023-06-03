<?php

namespace App\Http\Controllers\API\V1\Seller\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerAuthServices;

class CheckPhoneController extends Controller
{
    public function __construct(private SellerAuthServices $authServices)
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
