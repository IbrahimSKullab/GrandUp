<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponseTrait;

class GetCountryUserMiddleware
{
    use HandleApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        $country_id = $request->header('country_id');

//        if (empty($country_id)) {
//            return $this::sendFailedResponse(__('Must Be Select Country'));
//        }

        $seller_local_ids = Seller::sellerLocal()->planExpiredAt()->where('country_id', 1)->pluck('id')->toArray();

        $request->merge([
            'seller_local_ids' => $seller_local_ids,
        ]);

        return $next($request);

    }
}
