<?php

namespace Database\Seeders;

use App\Enums\ShippingEnum;
use App\Models\ShippingDelivery;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ShippingCompanySedder extends Seeder
{
    public function run()
    {

        $shipping_company = ShippingCompany::query()->create([
            'name' => 'شركة الشحن الأولي',
            'phone' => '1234567891',
            'current_points' => '10000',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'hashed_login_otp' => Hash::make('123456789'),
            'device_token' => 'Device Token From Firebase',
        ]);

        $shipping_company->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(ShippingEnum::SHIPPING_COMPANY_PROFILE_COLLECTION->value);

        $shipping_delivery = ShippingDelivery::query()->create([
            'shipping_company_id' => $shipping_company->id,
            'name' => 'الندوب الأول',
            'phone' => '1234567891',
            'country_id' => 1,
            'governorate_id' => 1,
            'current_points' => '10000',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'hashed_login_otp' => Hash::make('123456789'),
            'device_token' => 'Device Token From Firebase',
        ]);
    }
}
