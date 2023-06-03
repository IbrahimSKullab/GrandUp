<?php

namespace App\Http\Resources\Seller;

use DB;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Governorate\GovernorateResource;
use App\Http\Resources\SubCategory\SubCategoryResource;

class SellerPublicResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $authUser = Helper::getAuthUserFromAccessToken();

        $is_friend = DB::table('friend_requests')
            ->where('user_id', $authUser?->id)
            ->where('seller_id', $this->id)
            ->where('friend_request_accepted_from_seller', 1)
            ->exists();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'seller_code' => $this->seller_code,
            'description' => $this->description,
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'whatsapp_number' => $this->whatsapp_number,
            'governorate' => GovernorateResource::make($this->governorate),
            'is_public_store' => $this->is_public_store,
            'default_currency' => $this->default_currency,
            'order' => $this->order,
            'profile_image' => $this->profile_image,
            'seller_dynamic_link' => $this->seller_dynamic_link,
            'seller_qr_code' => $this->seller_qr_code,
            'created_at' => Helper::formatDate($this->created_at),
            'show_seller_points' => $this->showSellerPoints(),
            'is_friend' => $is_friend,
            'is_auth_user_friend_to_seller' => $this->mergeWhen(request()->routeIs('api.get-seller.*'), function () {
                $authUser = Helper::getAuthUserFromAccessToken();

                return DB::table('friend_requests')
                    ->where('user_id', $authUser?->id)
                    ->where('seller_id', $this->id)
                    ->where('friend_request_accepted_from_seller', 1)
                    ->exists();
            }),
            'is_auth_user_send_friend_request_to_seller' => $this->mergeWhen(request()->routeIs('api.get-seller.*'), function () {
                $authUser = Helper::getAuthUserFromAccessToken();

                return DB::table('friend_requests')
                    ->where('user_id', $authUser?->id)
                    ->where('seller_id', $this->id)
                    ->where('friend_request_accepted_from_seller', 0)
                    ->exists();
            }),
            'categories' => $this->whenLoaded('categories', fn () => CategoryResource::collection($this->categories()->latest()->get())),
            'sub_categories' => $this->whenLoaded('subCategories', fn () => SubCategoryResource::collection($this->subCategories()->latest()->get())),
            'new_products' => $this->whenLoaded('newProducts', fn () => ProductResource::collection($this->newProducts()->take(15)->get())),
            'products_with_points' => $this->whenLoaded('productPoints', fn () => ProductResource::collection($this->productPoints()->orderBy('points', 'desc')->take(15)->get())),
            'other_products' => $this->whenLoaded('otherProducts', fn () => ProductResource::collection($this->otherProducts()->take(15)->get())),
        ];
    }
}
