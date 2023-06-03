<?php

namespace App\Http\Controllers\API\V1\User\Search;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;

class ProductAlgoliaController extends Controller
{
    public function index(Request $request)
    {
        $seller_ids = $request->seller_local_ids;

        if (! is_null($request->titlesearch)) {
            $items = SellerProduct::search($request->titlesearch)->paginate(10);

            $items_store = $items->pluck('id')->toArray();

            $items = SellerProduct::whereIN('seller_id', $seller_ids)->whereIN('id', $items_store)->latest()->active()->paginate(10);

        } else {
            $items = SellerProduct::whereIN('seller_id', $seller_ids)->latest()->active()->paginate(10);
        }

        return $this::sendSuccessResponse(ProductResource::collection($items));
    }
}
