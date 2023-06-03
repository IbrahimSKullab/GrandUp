<?php

namespace App\Http\Controllers\API\V1\ShippingDelivery\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ShippingDelivery\ShippingDeliveryAuthServices;
use App\Http\Requests\API\Auth\ShippingDelivery\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private ShippingDeliveryAuthServices $shippingDeliveryAuthServices)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $shipping_company = $request->authenticate();

            $this->shippingDeliveryAuthServices->generateOtp($shipping_company);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Otp Send Successfully'));
    }
}
