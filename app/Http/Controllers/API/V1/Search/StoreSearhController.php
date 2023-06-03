<?php

namespace App\Http\Controllers\API\V1\Search;

use App\Http\Resources\Seller\SellerResource;
use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\POS\SearchRequest;

class StoreSearhController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $results = Seller::whereLike([
            'store_number', 'country.title', 'governorate.title',
        ], $request->keyword)->planExpiredAt()->get();

        return $this::sendSuccessResponse(SellerResource::collection($results));
    }
}
