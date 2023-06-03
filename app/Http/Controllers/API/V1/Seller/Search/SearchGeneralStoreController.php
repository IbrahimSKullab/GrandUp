<?php

namespace App\Http\Controllers\API\V1\Seller\Search;

use App\Http\Resources\Seller\SellerMiniResource;
use App\Models\Seller;
use App\Models\Country;
use App\Models\Category;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Governorate\GovernorateResource;

class SearchGeneralStoreController extends Controller
{
    public function GetCommonSearch(Request $request)
    {
        $countries = Country::get();

        $governorates = Governorate::get();

        $categories = Category::get();

        $data = [
            'countries' => CountryResource::collection($countries),
            'governorates' => GovernorateResource::collection($governorates),
            'categories' => CategoryResource::collection($categories),
        ];

        return $this::sendSuccessResponse($data);
    }

    public function GetGovernorateByCountry($country_id)
    {
        $governorates = Governorate::where('country_id', $country_id)->get();

        $data = GovernorateResource::collection($governorates);

        return $this::sendSuccessResponse($data);
    }

    public function GetGeneralStore(Request $request, $is_public_store)
    {
        $sellers = Seller::query()->where('is_public_store', $is_public_store);

        $sellers->when(! empty($request->country_id), function ($q) use ($request) {
            return $q->where('country_id', $request->country_id);
        });

        $sellers->when(! empty($request->governorate_id), function ($q) use ($request) {
            return $q->where('governorate_id', $request->governorate_id);
        });

        $sellers->when(! empty($request->category_id), function ($query) use ($request) {
            return $query->whereHas('categories', function ($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            });
        });

        $sellers->when(! empty($request->name), function ($q) use ($request) {
            return $q->where('name', 'like', '%'.$request->name.'%');
        });

        $sellers->when(! empty($request->store_number), function ($q) use ($request) {
            return $q->where('store_number', 'like', '%'.$request->store_number.'%');
        });


        $data = $sellers->planExpiredAt()->get();

        $responce = SellerMiniResource::collection($data);

        return $this::sendSuccessResponse($responce);
    }
}
