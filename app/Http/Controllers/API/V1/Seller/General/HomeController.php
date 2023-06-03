<?php

namespace App\Http\Controllers\API\V1\Seller\General;

use App\Services\Category\SubCategoryServices;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use App\Services\Slider\SliderServices;
use App\Services\Product\ProductServices;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Slider\SliderResource;
use App\Http\Resources\Product\ProductResource;
use App\Services\Seller\SellerCategoryServices;
use App\Services\Seller\SellerSubCategoryServices;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Services\Administration\AdministrationServices;
use App\Http\Resources\AdministrationService\AdministrationServiceResource;

class HomeController extends Controller
{
    public function __construct(
        private SliderServices            $sliderServices,
        private ProductServices           $productServices,
        private SellerCategoryServices    $sellerCategoryServices,
//        private SellerSubCategoryServices $sliderSubCategoryServices,
        private SellerServices            $sellerServices,
        private AdministrationServices    $administrationServices,
        private SubCategoryServices $subCategoryServices

    ) {
    }

    public function getSlider(): JsonResponse
    {
        $slider = SliderResource::collection($this->sliderServices->getGeneral());

        return $this::sendSuccessResponse($slider);
    }

    public function getSubCategory($id): JsonResponse
    {
        $sub_category = SubCategoryResource::collection($this->subCategoryServices->getSubCategoryByCategoryId($id));

        return $this::sendSuccessResponse($sub_category);
    }

    public function getProductByCategory($id): JsonResponse
    {
        $product = ProductResource::collection($this->productServices->getProductByCategoryId($id, true));

        return $this::sendSuccessResponse($product);
    }

    public function getProductBySubCategory($id): JsonResponse
    {
        $product = ProductResource::collection($this->productServices->getProductBySubCategoryId($id, true));

        return $this::sendSuccessResponse($product);
    }

    public function getSellerClassification($id)
    {
        $seller = SellerResource::collection($this->sellerCategoryServices->getSellerClassification($id, false));

        return $this::sendSuccessResponse($seller);
    }

    public function getSellerGenera()
    {
        $seller = SellerResource::collection($this->sellerServices->getGeneral());

        return $this::sendSuccessResponse($seller);
    }

    public function getAdministrationService()
    {
        $administration = AdministrationServiceResource::collection($this->administrationServices->getAdministrationServiceApi());

        return $this::sendSuccessResponse($administration);
    }

    public function getProductStoreNew()
    {
        $product = ProductResource::collection($this->productServices->getProductStoreNew(true));

        return $this::sendSuccessResponse($product);
    }
}
