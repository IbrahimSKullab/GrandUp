<?php

namespace App\Http\Controllers\API\V1\Store;

use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use App\Http\Resources\Seller\SellerPublicResource;

class SellerController extends Controller
{
    public function __construct(private SellerServices $sellerServices)
    {
    }

    public function index()
    {
        $sellers = $this->sellerServices->getEnabledSellers();

        return $this::sendSuccessResponse([
            'count' => $this->sellerServices->count(),
            'sellers' => SellerPublicResource::collection($sellers),
        ]);
    }

    public function show($id)
    {
        $seller = $this->sellerServices->findById($id, true);
        $seller->load(['categories', 'subCategories', 'newProducts', 'productPoints', 'otherProducts']);

        return $this::sendSuccessResponse(SellerPublicResource::make($seller));
    }

    public function getNewProducts($seller_id)
    {
        return $this::sendSuccessResponse($this->sellerServices->getNewProducts($seller_id));
    }

    public function getProductWithPoints($seller_id)
    {
        return $this::sendSuccessResponse($this->sellerServices->getProductWithPoints($seller_id));
    }

    public function getOtherProducts($seller_id)
    {
        return $this::sendSuccessResponse($this->sellerServices->getOtherProducts($seller_id));
    }

    public function getHomeSellers()
    {
        $sellers = $this->sellerServices->getEnabledSellers(config('app.homepage_stores_pagination_count'));

        return $this::sendSuccessResponse(SellerPublicResource::collection($sellers));
    }
}
