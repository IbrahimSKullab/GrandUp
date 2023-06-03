<?php

namespace App\Http\Resources\Product;

use App\Helper\Helper;
use App\Enums\ProductEnum;
use Illuminate\Http\Request;
use App\Enums\FriedRequestEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Seller\SellerPublicResource;
use App\Http\Resources\SubCategory\SubCategoryResource;
use Illuminate\Support\Facades\DB;

class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        $user = request()->user ?: request()->user();

        $variation = [];
        $attributes = [];

        if ((is_array($this['attributes']) ? $this['attributes'] : json_decode($this['attributes'])) != null) {
            $attributes_arr = is_array($this['attributes']) ? $this['attributes'] : json_decode($this['attributes']);
            foreach ($attributes_arr as $attribute) {
                $attributes[] = (integer)$attribute;
            }
        }

        $data['attributes'] = $attributes;
        $data['choice_options'] = is_array($this['choice_options']) ? $this['choice_options'] : json_decode($this['choice_options']);
        $variation_arr = is_array($this['variation']) ? $this['variation'] : json_decode($this['variation'], true);
        if (! is_null($variation_arr)) {
            foreach ($variation_arr as $var) {
                $variation[] = [
                    'type' => $var['type'],
                    'price' => (double)$var['price'],
                    'sku' => $var['sku'],
                    'qty' => (integer)$var['qty'],
                ];
            }
        }
        $data['variation'] = $variation;
        
        $is_ordinary_friend = false;
        $is_special_friend = false;
        $can_user_show_points = true;

        if ($request->bearerToken()) {
            $authUser = Helper::getAuthUserFromAccessToken();

            if ($authUser) {
                $is_ordinary_friend = DB::table('friend_requests')
                    ->where('seller_id', $this->seller_id)
                    ->where('user_id', $authUser->id)
                    ->where('friendship_type', FriedRequestEnum::ORDINARY->name)
                    ->where('friend_request_accepted_from_seller', 1)
                    ->exists();
                $is_special_friend = DB::table('friend_requests')
                    ->where('seller_id', $this->seller_id)
                    ->where('user_id', $authUser->id)
                    ->where('friendship_type', FriedRequestEnum::SPECIAL->name)
                    ->where('friend_request_accepted_from_seller', 1)
                    ->exists();

                if (DB::table('users')->where('enable_viewing_points', 1)->exists()) {
                    $can_user_show_points = DB::table('users')
                        ->where('id', $authUser->id)
                        ->where('enable_viewing_points', 1)
                        ->exists();
                }
            }
        }

        return [
            'id' => $this->id,

            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,
            'is_favorite' => $user ? $this->isFavorited($user->id) : false,

            'is_shared' => (boolean)$this->is_shared,
            'share_product' => (boolean)$this->is_editable,

            'product_size' => $this->product_size,

            'status' => $this->status,
            'new_product' => $this->new_product,
            'admin_approval' => $this->admin_approval,
            'video_link' => $this->video_link,
            'price' => $this->price,

            'special_price' => $this->special_price,
            'is_ordinary_friend' => $is_ordinary_friend,
            'is_special_friend' => $is_special_friend,
            'can_user_show_points' => $can_user_show_points,

            'category' => $this->whenLoaded('category', fn () => CategoryResource::make($this->category)),
            'sub_category' => $this->whenLoaded('subCategory', fn () => SubCategoryResource::make($this->subCategory)),
            'points' => $this->points,
            'image' => $this->image,
            'qr_code' => $this->qr_code,
            'product_rejected' => $this->product_rejected,
            'rejection_reason' => $this->rejection_reason,
            'product_dynamic_link' => $this->product_dynamic_link,
            'images' => Helper::getModelMultiMediaUrls($this, ProductEnum::PRODUCT_IMAGES_COLLECTION->name),
            'default_currency' => $this->seller->default_currency,
            'seller' => SellerPublicResource::make($this->seller),
            'increase_by' => 1,
            'variation' => $data,
        ];
    }
}
