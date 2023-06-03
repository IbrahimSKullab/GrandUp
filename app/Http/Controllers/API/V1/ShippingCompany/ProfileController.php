<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Models\ShippingCompany;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingCompany\ShippingCompanyResource;

class ProfileController extends Controller
{
    public function index()
    {
        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        return $this::sendSuccessResponse(ShippingCompanyResource::make($shipping_company));
    }

    public function logout()
    {

        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        $shipping_company->tokens()->delete();

        return $this::sendSuccessResponse('', __('Logout'));
    }
}
