<?php

namespace App\Http\Controllers\API\V1\Seller\Profile;

use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use Illuminate\Http\Request;

class ReceiverOrderController extends Controller
{
    public function __construct(private  SellerServices $sellerServices)
    {
    }

    public function __invoke(Request $request)
    {
        $seller = $this->sellerServices->receiverOrderStore($request);
        return $this::sendSuccessResponse($seller);
    }
}
