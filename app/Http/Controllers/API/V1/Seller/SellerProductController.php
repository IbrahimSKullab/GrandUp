<?php

namespace App\Http\Controllers\API\V1\Seller;

use App\Models\Seller;
use App\Models\SellerSharedProduct;
use App\Notifications\Seller\SharedProductNotification;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductServices;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;

class SellerProductController extends Controller
{
    public function __construct(private ProductServices $productServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse([
            'count' => $this->productServices->getCount(),
            'data' => ProductResource::collection($this->productServices->getSellerProducts()),
        ]);
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(ProductResource::make($this->productServices->findSellerProductById($id)));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productServices->storeForSeller($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('The product has been sent successfully, and you will be notified of approval or rejection through a notification that reaches your phone'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $this->productServices->updateForSeller($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Updated Successfully'));
    }

    public function destroy($id)
    {
        try {
            $this->productServices->destroyForSeller($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Deleted Successfully'));
    }

    public function toggleStatus($id)
    {
        try {
            $this->productServices->toggleStatusForSeller($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Status Changed Successfully'));
    }

    public function storeVariation(Request $request, $id){
        try {
            $this->productServices->storeVariation($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Save Successfully'));
    }

    public function shared($id){
        try {
            $product = $this->productServices->findById($id);

            if ($product->is_shared == false) {
                return $this::sendFailedResponse( __('Product Not Shared'));
            }

           $product_shared = SellerSharedProduct::create([
                'seller_id' => $product->seller_id,
                'user_seller_id' => auth()->user()->id,
                'seller_product_id' => $product->id,
            ]);

            $seller = Seller::where('id', $product->seller_id)->first();

            $seller->notify(new SharedProductNotification($product_shared));


        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Save Successfully'));
    }
}
