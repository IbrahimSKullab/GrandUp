<?php

namespace App\Http\Resources\Seller;

use DB;
use Carbon\Carbon;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Governorate\GovernorateResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $seller_code
 * @property mixed $description
 * @property mixed $location
 * @property mixed $phone
 * @property mixed $email
 * @property mixed $whatsapp_number
 * @property mixed $governorate
 * @property mixed $is_public_store
 * @property mixed $profile_image
 * @property mixed $device_token
 * @property mixed $device_type
 * @property mixed $current_points
 * @property mixed $app_version
 * @property mixed $default_lang
 * @property mixed $created_at
 */
class SellerResource extends JsonResource
{
    public function toArray($request): array
    {
        $user = request()->user ?: request()->user();
        $startOfDay = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $endOfDay = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');

        $startOfMonth = Carbon::now()->startOfMonth()->startOfDay()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->endOfDay()->format('Y-m-d H:i:s');

        $data = [];
        if ($this->is_public_store == 2) {
            $data = [
                'time_from' => $this->time_from,
                'time_to' => $this->time_to,
                'now_status' => Helper::OperNowStore($this->time_from, $this->time_to),
            ] ?: null;
        }

        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'seller_code' => $this->seller_code,
            'store_number' => $this->store_number,
            'is_favorite' => $user ? $this->isFavorited($user->id) : false,

            'description' => $this->description,
            'location' => $this->location,
            'phone' => $this->phone,
            'card_number' => $this->whatsapp_number,
            'email' => $this->email,
            'whatsapp_number' => $this->whatsapp_number,
            'governorate' => GovernorateResource::make($this->governorate),
            'country' => GovernorateResource::make($this->country),
            'is_public_store' => $this->is_public_store,
            'store_status' => $data,
            'profile_image' => $this->profile_image,
            'seller_dynamic_link' => $this->seller_dynamic_link,
            'seller_qr_code' => $this->seller_qr_code,
            'store_gps_location' => json_decode($this->store_gps_location),

            'show_seller_points' => $this->showSellerPoints(),
            'default_currency' => $this->default_currency,

            'product_count' => $this->products()->count(),
            'order_count' => $this->orders()->count(),
            'friend_request' => $this->friendRequest()->count(),
            'current_points' => $this->current_points,

            'today_sales' => DB::table('orders')->where('seller_id', $this->id)->whereBetween('created_at', [$startOfDay, $endOfDay])->sum('total_cost'),
            'monthly_sales' => DB::table('orders')->where('seller_id', $this->id)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_cost'),

            'enable_notification' => $this->enable_notification,
            'plan_expired' => $this->plan_expired_at ? [
                'timestamp' => Carbon::parse($this->plan_expired_at)->timestamp,
                'date' => $this->plan_expired_at,
                'diff_in_days' => Carbon::parse($this->plan_expired_at)->diffInDays(),
            ] : null,

            // Basic Info
            'device_token' => $this->device_token,
            'device_type' => $this->device_type,
            'app_version' => $this->app_version,
            'default_lang' => $this->default_lang,
            'created_at' => Helper::formatDate($this->created_at),
            'review' => $this->_rating()
        ];
    }
}
