<?php

namespace App\Http\Controllers\API\V1\User;

use App\Models\Seller;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\API\User\GetFavoriteRequest;
use App\Http\Requests\API\User\AddOrDeleteFavoriteRequest;

class UserController extends Controller
{
    public function __construct()
    {
    }
    public function getFavorite(GetFavoriteRequest $request)
    {
        $user = Auth::user();

        $favoritable = null;
        $favoritable_resource = null;

        switch ($request->favoritable) {
            case 'product':
                $favoritable = SellerProduct::class;
                $favoritable_resource = ProductResource::class;

                break;
            case 'seller':
                $favoritable = Seller::class;
                $favoritable_resource = SellerResource::class;

                break;
        }

        $favorites = $favoritable_resource::collection($user->favorite($favoritable));

        return $this::sendSuccessResponse($favorites);
    }

    public function addOrDeleteFavorite(AddOrDeleteFavoriteRequest $request)
    {
        $user = Auth::user();

        $favoritables = [
            'seller' => Seller::class,
            'product' => SellerProduct::class,
        ];

        $favoritable_object = $favoritables[$request->favoritable]::findOrFail($request->favoritable_id);

        if ($favoritable_object->isFavorited($user->id)) {
            $user->removeFavorite($favoritable_object);
            $message = __('Item Removed From Favorite');
        } else {
            $user->addFavorite($favoritable_object);
            $message = __('Item Added To Favorite');
        }

        return $this::sendSuccessResponse('', $message);

    }
}
