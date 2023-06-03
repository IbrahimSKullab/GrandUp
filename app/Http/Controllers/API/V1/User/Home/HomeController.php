<?php

namespace App\Http\Controllers\API\V1\User\Home;


use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductMiniResource;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductServices;

class HomeController extends Controller
{
    public function __construct(private ProductServices $productServices)
    {
    }

    public function newProduct()
    {
        $orders = $this->productServices->get();

        return $this::sendSuccessResponse(ProductResource::collection($orders));
    }


}
