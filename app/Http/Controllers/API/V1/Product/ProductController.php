<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Slider\SliderResource;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Models\ProductAdsSlider;
use App\Models\ProductExhibition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductServices;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function __construct(private ProductServices $productServices)
    {
    }

    public function index(Request $request)
    {
        $data = $this->productServices->getEnabledProducts($request);

        return $this::sendSuccessResponse($data);
    }

    public function show($id)
    {
        $product = $this->productServices->findById($id, true);
        $product->load(['category', 'subCategory']);

        return $this::sendSuccessResponse(ProductResource::make($product));
    }

    public function getProducts(Request $request)
    {
        $seller_ids = $request->seller_local_ids;

        $product_query = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active();

//        $product_query->when(! empty($request->attribute), function ($q) use ($request) {
//            return $q->whereJsonContains('attributes', $request->attribute);
//        });

        $product_query->when(! empty($request->option) || ! empty($request->attribute), function ($q) use ($request) {
            $positions = $request->get('attribute');
            foreach ($positions as $key => $value) {
                $q->whereJsonContains('attributes', $value)->whereJsonContains('choice_options', [['options' => $request->option[$key]]]);
            }
        });

        $product_query->when(! empty($request->seller_id), function ($q) use ($request) {
            return $q->where('seller_id', $request->seller_id);
        });

        $product_query->when(! empty($request->is_new), function ($q) use ($request) {
            return $q->orderBy('created_at', 'DESC');
        });

        $product_query->when(! empty($request->is_point), function ($q) use ($request) {
            return $q->whereNotNull('points');
        });

        $product_query->when(! empty($request->is_offer), function ($q) use ($request) {
            $activeOffers = ProductOffer::where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->latest()
                ->pluck('seller_product_id')
                ->unique()
                ->toArray();

            return $q->whereIN('id', $activeOffers);
        });

        $product_query->when(! empty($request->is_exhibition), function ($q) use ($request) {
            $activeOffers = ProductExhibition::where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->latest()
                ->pluck('seller_product_id')
                ->unique()
                ->toArray();

            return $q->whereIN('id', $activeOffers);
        });

        $product_query->when(! empty($request->is_best_sell), function ($q) use ($request) {
            $orders_product = OrderItem::with('product')
                ->whereHas('product', function ($query) {
                    $query->active();
                })
                ->select('seller_product_id', DB::raw('COUNT(seller_product_id) as count'))
                ->groupBy('seller_product_id')
                ->pluck('seller_product_id')
                ->toArray();

            return $q->whereIN('id', $orders_product);
        });

        $product_query->when(! empty($request->category_id), function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        });

        $product_query->when(! empty($request->sub_category_id), function ($q) use ($request) {
            return $q->where('sub_category_id', $request->sub_category_id);
        });

        $product_query->when(! empty($request->search), function ($q) use ($request) {
            return $q->where('title->ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title->en', 'LIKE', '%' . $request->search . '%');
        });

        $products = $product_query->customPagination()->get();

        $data = [
            'count' => $products->count(),
            'products' => ProductResource::collection($products),
        ];

        return $this::sendSuccessResponse($data);
    }

    public function getAllSections(Request $request)
    {
        $seller_ids = $request->seller_local_ids;

        $product_new = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active()->orderBy('created_at', 'DESC')->limit(5)->get();
        $product_point = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active()->orderBy('created_at', 'DESC')->whereNotNull('points')->limit(5)->get();

        $activeOffers = ProductOffer::where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->latest()
            ->pluck('seller_product_id')
            ->unique()
            ->toArray();
        $product_offer = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active()->orderBy('created_at', 'DESC')->whereIN('id', $activeOffers)->limit(5)->get();

        $activeExhibition = ProductExhibition::where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->latest()
            ->pluck('seller_product_id')
            ->unique()
            ->toArray();
        $product_exhibition = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active()->orderBy('created_at', 'DESC')->whereIN('id', $activeExhibition)->limit(5)->get();

        $orders_best = OrderItem::with('product')
            ->whereHas('product', function ($query) {
                $query->active();
            })
            ->select('seller_product_id', DB::raw('COUNT(seller_product_id) as count'))
            ->groupBy('seller_product_id')
            ->pluck('seller_product_id')
            ->toArray();
        $product_best_sell = SellerProduct::query()->whereIN('seller_id', $seller_ids)->active()->orderBy('created_at', 'DESC')->whereIN('id', $orders_best)->limit(5)->get();

        $categories = Category::query()->where('status', 1)
            ->latest()
            ->limit(10)
            ->get();

        $product_slider = ProductAdsSlider::query()
            ->where('start_at', '<', now())
            ->where('end_at', '>', now())
            ->where('status', 'accepted')
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'sliders' => SliderResource::collection($product_slider),
            'categories' => CategoryResource::collection($categories),
            'recently_added' => ProductResource::collection($product_new),
            'points-products' => ProductResource::collection($product_point),
            'special-offers-products' => ProductResource::collection($product_offer),
            'exhibition_product' => ProductResource::collection($product_exhibition),
            'top-sold' => ProductResource::collection($product_best_sell),
        ];

        return $this::sendSuccessResponse($data);
    }
}
