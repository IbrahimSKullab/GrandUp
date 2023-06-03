<?php

namespace App\Http\Resources\Product;

use DB;
use App\Helper\Helper;
use App\Enums\ProductEnum;
use Illuminate\Http\Request;
use App\Enums\FriedRequestEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Seller\SellerPublicResource;
use App\Http\Resources\SubCategory\SubCategoryResource;

class BestSellingProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $variation = [];
        $attributes = [];

        if ((is_array($this->product['attributes']) ? $this->product['attributes'] : json_decode($this->product['attributes'])) != null) {
            $attributes_arr = is_array($this->product['attributes']) ? $this->product['attributes'] : json_decode($this->product['attributes']);
            foreach ($attributes_arr as $attribute) {
                $attributes[] = (integer)$attribute;
            }
        }

        $data['attributes'] = $attributes;
        $data['choice_options'] = is_array($this->product['choice_options']) ? $this->product['choice_options'] : json_decode($this->product['choice_options']);
        $variation_arr = is_array($this->product['variation']) ? $this->product['variation'] : json_decode($this->product['variation'], true);
        if (!is_null($variation_arr)){
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
                    ->where('seller_id', $this->product->seller_id)
                    ->where('user_id', $authUser->id)
                    ->where('friendship_type', FriedRequestEnum::ORDINARY->name)
                    ->where('friend_request_accepted_from_seller', 1)
                    ->exists();
                $is_special_friend = DB::table('friend_requests')
                    ->where('seller_id', $this->product->seller_id)
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
            'id' => $this->product->id,

            'title' => $this->product->title,
            'code' => $this->product->code,
            'description' => $this->product->description,

            'product_size' => $this->product->product_size,

            'status' => $this->product->status,
            'new_product' => $this->product->new_product,
            'admin_approval' => $this->product->admin_approval,
            'video_link' => $this->product->video_link,
            'price' => $this->product->price,

            'special_price' => $this->product->special_price,
            'is_ordinary_friend' => $is_ordinary_friend,
            'is_special_friend' => $is_special_friend,
            'can_user_show_points' => $can_user_show_points,

//            'category' => $this->product->whenLoaded('category', fn () => CategoryResource::make($this->product->category)),
//            'sub_category' => $this->product->whenLoaded('subCategory', fn () => SubCategoryResource::make($this->product->subCategory)),
            'points' => $this->product->points,
            'image' => $this->product->image,
            'qr_code' => $this->product->qr_code,
            'product_rejected' => $this->product->product_rejected,
            'rejection_reason' => $this->product->rejection_reason,
            'product_dynamic_link' => $this->product->product_dynamic_link,
            'images' => Helper::getModelMultiMediaUrls($this->product, ProductEnum::PRODUCT_IMAGES_COLLECTION->name),
            'default_currency' => $this->product->seller->default_currency,
            'seller' => SellerPublicResource::make($this->product->seller),
            'increase_by' => 1,
            'variation' => $data
        ];
    }
}
