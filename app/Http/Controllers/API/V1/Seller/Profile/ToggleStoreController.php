<?php

namespace App\Http\Controllers\API\V1\Seller\Profile;

use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;

class ToggleStoreController extends Controller
{
    public function __construct(private SellerServices $sellerServices)
    {
    }

    public function __invoke()
    {
        $this->sellerServices->toggleStore();
        
        return $this::sendSuccessResponse([]);
    }
}
