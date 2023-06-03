<?php

namespace App\Http\Controllers\API\V1\Seller\Search;

use App\Models\SellerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\API\POS\SearchRequest;

class ProductsSearhController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $results = SellerProduct::with('seller')->whereHas('seller', function ($query) {
            return $query->planExpiredAt()->where('is_public_store', 1);
        })->where('title', 'LIKE', "%{$request->keyword}%")->get();

        if (count($results) === 0) {
            $results = SellerProduct::inRandomOrder()->take(5)->get();
        }

        return $this::sendSuccessResponse($results);
    }
}
