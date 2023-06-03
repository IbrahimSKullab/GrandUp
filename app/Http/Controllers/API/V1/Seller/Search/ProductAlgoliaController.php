<?php

namespace App\Http\Controllers\API\V1\Seller\Search;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;

class ProductAlgoliaController extends Controller
{
    public function index(Request $request)
    {
        if (! is_null($request->titlesearch)) {
            $items = SellerProduct::search($request->titlesearch)->paginate(10);

            $items_store = $items->pluck('id')->toArray();

            $items = SellerProduct::with('seller')->whereHas('seller', function ($query) {
                return $query->where('is_public_store', 1)->planExpiredAt();
            })->whereIN('id', $items_store)->latest()->active()->paginate(10);

        } else {
            $items = SellerProduct::with('seller')->whereHas('seller', function ($query) {
                return $query->where('is_public_store', 1)->planExpiredAt();
            })->latest()->active()->paginate(10);
        }

        return $this::sendSuccessResponse(ProductResource::collection($items));
    }
}
