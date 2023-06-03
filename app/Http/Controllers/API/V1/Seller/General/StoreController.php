<?php

namespace App\Http\Controllers\API\V1\Seller\General;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use App\Services\Product\ProductServices;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Product\ProductResource;
use App\Services\Seller\SellerCategoryServices;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Seller\SellerSubCategoryServices;
use App\Http\Resources\SubCategory\SubCategoryResource;

class StoreController extends Controller
{
    public function __construct(
        private SellerCategoryServices    $sellerCategoryServices,
        private SellerSubCategoryServices $sellerSubCategoryServices,
        private SellerServices            $sellerServices,
        private ProductServices           $productServices,
    ) {
    }

    public function getStore($id): JsonResponse
    {
        $store = new SellerResource($this->sellerServices->getGeneralStore($id));

        return $this::sendSuccessResponse($store);
    }

    public function getStoreCategory($id): JsonResponse
    {
        $category = CategoryResource::collection($this->sellerCategoryServices->getCategoryGeneralStore($id));

        return $this::sendSuccessResponse($category);
    }

    public function getStoreSubCategory($id, $store_id): JsonResponse
    {
        $sub_category = SubCategoryResource::collection($this->sellerSubCategoryServices->getSubCategoryGeneralStore($id, $store_id));

        return $this::sendSuccessResponse($sub_category);
    }

    public function getProductStoreByCategory($id, $store_id)
    {
        $product = ProductResource::collection($this->productServices->getProductStoreByCategoryId($id, $store_id, true));

        return $this::sendSuccessResponse($product);
    }

    public function getProductStoreBySubCategory($id, $store_id)
    {
        $product = ProductResource::collection($this->productServices->getProductStoreBySubCategoryId($id, $store_id, true));

        return $this::sendSuccessResponse($product);
    }

    public function getProductStore($store_id)
    {
        $product = ProductResource::collection($this->productServices->getProductStore($store_id, true));

        return $this::sendSuccessResponse($product);
    }
}
