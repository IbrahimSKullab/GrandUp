<?php

namespace App\Http\Resources\GeneralSetting;

use App\Helper\Helper;
use App\Enums\GeneralSettingEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralSettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'logo' => Helper::getFirstMediaUrl($this, GeneralSettingEnum::LOGO_IMAGE->value),
            'default_profile_image' => Helper::getFirstMediaUrl($this, GeneralSettingEnum::DEFAULT_PROFILE_IMAGE->value),
            'first_email' => $this->first_email,
            'second_email' => $this->second_email,
            'first_phone' => $this->first_phone,
            'second_phone' => $this->second_phone,
            'facebook_link' => $this->facebook_link,
            'twitter_link' => $this->twitter_link,
            'instagram_link' => $this->instagram_link,
            'linkedin_link' => $this->linkedin_link,
            'tiktok_link' => $this->tiktok_link,
            'snapchat_link' => $this->snapchat_link,
            'app_version' => $this->app_version,
            'google_play_link' => $this->google_play_link,
            'apple_store_link' => $this->apple_store_link,
            'minimum_points_to_view_points_in_products' => $this->minimum_points_to_view_points_in_products,

            'minimum_days_of_offer' => $this->minimum_days_of_offer,
            'maximum_days_of_offer' => $this->maximum_days_of_offer,
            'offer_point_for_each_day' => $this->offer_point_for_each_day,

            'minimum_days_of_slider' => $this->minimum_days_of_slider,
            'maximum_days_of_slider' => $this->maximum_days_of_slider,
            'slider_point_for_each_day' => $this->slider_point_for_each_day,

            'upload_product_points' => $this->upload_product_points,
            'product_excelsheet' => asset('files/products_example.xlsx'),

            'seller_registration_content' => $this->seller_registration_content,
            'enable_seller_page' => $this->enable_seller_page,

            'seller_android_app_link' => $this->seller_android_app_link,
            'seller_ios_app_link' => $this->seller_ios_app_link,

            'ar_json_file' => json_decode(file_get_contents(base_path('lang/ar.json')), true),
            'en_json_file' => json_decode(file_get_contents(base_path('lang/en.json')), true),

        ];
    }
}
