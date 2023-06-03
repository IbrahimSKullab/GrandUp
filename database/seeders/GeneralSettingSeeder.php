<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;
use App\Enums\GeneralSettingEnum;

class GeneralSettingSeeder extends Seeder
{
    public function run()
    {
        $setting = GeneralSetting::query()->create([
            'title' => [
                'ar' => 'الكمال ستور',
                'en' => 'AlKamal Store',
            ],
            'description' => [
                'ar' => 'الكمال ستور',
                'en' => 'AlKamal Store',
            ],
            'first_email' => 'admin@admin.com',
            'second_email' => 'admin@admin.com',
            'first_phone' => '009647502120570',
            'second_phone' => '009647502120570',
            'facebook_link' => 'https://facebook.com',
            'twitter_link' => 'https://twitter.com',
            'instagram_link' => 'https://instagram.com',
            'youtube_link' => 'https://youtube.com',
            'linkedin_link' => 'https://linkedin.com',
            'snapchat_link' => 'https://snapchat.com',
            'tiktok_link' => 'https://tiktok.com',

            'fcm_key' => 'AAAAJY49pYY:APA91bEDq85uPnZvkr6YCtc1diFADMWafW2iu72Xhmtoth6VOLMimRD-gnsjiWxWT-qVVrI_9khh5k2A-DsSFlVh4-gPeGd9uwed_JyeZW3x4HN57IILCHI3DFrEZZqpeE4nGL2LgKIm	',
            'firebase_api_key' => 'AIzaSyD4YpcWECdjWQ7dkLgw6zCiTZ7Jo9D-6V8',
            'firebase_auth_domain' => 'al-kamal-store-app.firebaseapp.com',
            'firebase_database_url' => 'https://al-kamal-store-app-default-rtdb.firebaseio.com',
            'firebase_project_id' => 'al-kamal-store-app',
            'firebase_storage_bucket' => 'al-kamal-store-app.appspot.com',
            'firebase_messaging_sender_id' => '161300194694',
            'firebase_app_id' => '1:161300194694:web:fa2eb906c2d5d4cb463807',

            'dynamic_link' => 'https://alkamalstores.page.link',
            'android_package_name' => 'com.alkamalstores',
            'ios_package_name' => 'com.alkamalstores',
            'ios_store_id' => '123456789',

            'google_play_link' => 'https://google.com',
            'apple_store_link' => 'https://apple.com',

            'vonage_api_key' => ENV('VONAGE_API_KEY'),
            'vonage_api_secret' => ENV('VONAGE_API_SECRET'),
            'vonage_brand_name' => ENV('VONAGE_BRAND_NAME'),
            'vonage_whatsapp_from_number' => ENV('VONAGE_WHATSAPP_FROM_NUMBER'),

            'seller_registration_content' => [
                'ar' => 'التعليمات هى عمل حساب متجر يجب ان تقوم بتحميل تطبيق المتجر وعمل حساب من داخل التطبيق',
                'en' => 'The instructions are to create a store account. You must download the store application and create an account from within the application',
            ],

            'seller_android_app_link' => 'https://google.com',
            'seller_ios_app_link' => 'https://apple.com',

        ]);

        $logo = public_path('logo.png');

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE->value);
        $setting->addMedia(public_path('logo.png'))->usingFileName('user.png')->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE->value);
        $setting->addMedia(public_path('logo.png'))->usingFileName('favicon.png')->preservingOriginal()->toMediaCollection(GeneralSettingEnum::FAVICON->value);
    }
}
