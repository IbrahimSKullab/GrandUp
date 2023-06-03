<?php

namespace App\Http\Controllers\API\V1\ShippingCompany\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ShippingCompany\ShippingCompanyAuthServices;
use App\Http\Requests\API\Auth\ShippingCompany\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private ShippingCompanyAuthServices $shippingCompanyAuthServices)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $shipping_company = $request->authenticate();

            $this->shippingCompanyAuthServices->generateOtp($shipping_company);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Otp Send Successfully'));
    }
}
