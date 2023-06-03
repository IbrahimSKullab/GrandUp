<?php

namespace App\Http\Controllers\API\V1\Seller\Home;

use App\Http\Resources\Product\BestSellingProductResource;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use App\Services\Product\ProductServices;
use App\Http\Resources\Order\OrderResource;
use App\Services\Category\CategoryServices;
use App\Services\Order\SellerOrderServices;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Category\CategoryResource;
use App\Services\FriendShip\SellerFriendShipServices;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(
        private ProductServices          $productServices,
        private CategoryServices         $categoryServices,
        private SellerOrderServices      $sellerOrderServices,
        private SellerFriendShipServices $sellerFriendShipServices,
        private SellerServices           $sellerServices,
    ) {
    }

    public function getReport(): JsonResponse
    {
        $data = [
            'order_count' => $this->sellerOrderServices->getCount(),
            'friend_request_count' => $this->sellerFriendShipServices->getCountFriendRequests(),
            'product_current_point' => $this->sellerServices->getPointSeller(),
            'product_count' => $this->productServices->getCount(),
            'daily_order' => $this->sellerOrderServices->getDailyCount(),
            'monthly_order' => $this->sellerOrderServices->getMonthlyCount(),
            'friend_count' => $this->sellerFriendShipServices->getCountFriends(),
            'review_count' => 0,
        ];

        return $this::sendSuccessResponse($data);
    }

    public function getLatestOrder(): JsonResponse
    {
        if (is_null($this->sellerOrderServices->getLatest())) {
            return $this::sendSuccessResponse();
        } else {
            return $this::sendSuccessResponse(new OrderResource($this->sellerOrderServices->getLatest()));
        }
    }

    public function getCategories(): JsonResponse
    {
        return $this::sendSuccessResponse(CategoryResource::collection($this->categoryServices->getEnabledCategories()));
    }

    public function getNewestProduct(): JsonResponse
    {
        return $this::sendSuccessResponse(ProductResource::collection($this->productServices->getGeneralProduct()));
    }

    public function getProductPoint(): JsonResponse
    {
        return $this::sendSuccessResponse(ProductResource::collection($this->productServices->getGeneralProductPoint()));
    }

    public function getExhibitionProduct(): JsonResponse
    {
        return $this::sendSuccessResponse(ProductResource::collection($this->productServices->getExhibitionProduct()));
    }

    public function getBestSelling(): JsonResponse
    {
        $product = OrderItem::with('product')
            ->whereHas('product', function ($query) {
                $query->active();
            })
            ->select('seller_product_id', DB::raw('COUNT(seller_product_id) as count'))
            ->groupBy('seller_product_id')
            ->orderBy('count', 'desc')
            ->customPagination()->get();

        return $this::sendSuccessResponse(BestSellingProductResource::collection($product));

    }
}
