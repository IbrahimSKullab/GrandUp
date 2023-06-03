<?php

namespace App\Http\Controllers\API\V1\ShippingCompany\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ShippingCompany\ShippingCompanyAuthServices;

class VerifyOtpController extends Controller
{
    public function __construct(private ShippingCompanyAuthServices $shippingCompanyAuthServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string',
            'otp_code' => 'required|string',
        ]);

        try {
            $user = $this->shippingCompanyAuthServices->verifyOtp($request->phone, $request->otp_code);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($user->getAuthResource());
    }
}
