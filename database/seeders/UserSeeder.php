<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\UserEnum;
use App\Enums\SellerEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Services\Seller\SellerServices;

class UserSeeder extends Seeder
{
    public function run()
    {
        $permission_seller = Permission::where('guard_name', 'seller')->pluck('name')->toArray();

        $user1 = User::query()->create([
            'name' => 'عبدالرحمن',
            'phone' => '1234567891',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'address' => 'العنوان المتاح',
            'device_token' => 'Device Token From Firebase',
            'invitation_code' => uniqid()
        ]);
        $user1->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $user2 = User::query()->create([
            'name' => 'محمد',
            'phone' => '1234567892',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'address' => 'العنوان المتاح',
            'device_token' => 'Device Token From Firebase',
            'invitation_code' => uniqid()
        ]);
        $user2->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $user3 = User::query()->create([
            'name' => 'عبدالله',
            'phone' => '1234567893',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'address' => 'العنوان المتاح',
            'device_token' => 'Device Token From Firebase',
            'invitation_code' => uniqid()
        ]);
        $user3->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $seller1 = Seller::query()->create([
            'name' => 'البائع الاول',
            'phone' => '1234567891',
            'location' => 'عنوان البائع',
            'seller_code' => '000001',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120570',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 1, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller1->syncPermissions($permission_seller);
        $seller1->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $seller2 = Seller::query()->create([
            'name' => 'البائع الثاني',
            'phone' => '1234567892',
            'location' => 'عنوان البائع',
            'seller_code' => '000002',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 1,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 2, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller2->syncPermissions($permission_seller);
        $seller2->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $seller3 = Seller::query()->create([
            'name' => 'البائع الثالث',
            'phone' => '1234567893',
            'location' => 'عنوان البائع',
            'seller_code' => '000003',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 2,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 3, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller3->syncPermissions($permission_seller);
        $seller3->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);

        $seller4 = Seller::query()->create([
            'name' => 'البائع الثالث',
            'phone' => '1234567894',
            'location' => 'عنوان البائع',
            'seller_code' => '000003',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 2,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 3, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller4->syncPermissions($permission_seller);
        $seller4->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
       
        $seller5 = Seller::query()->create([
            'name' => 'البائع الثالث',
            'phone' => '1234567895',
            'location' => 'عنوان البائع',
            'seller_code' => '000003',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 2,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 3, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller5->syncPermissions($permission_seller);
        $seller5->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
        
        $seller6 = Seller::query()->create([
            'name' => 'البائع الثالث',
            'phone' => '1234567896',
            'location' => 'عنوان البائع',
            'seller_code' => '000003',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 2,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 3, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller6->syncPermissions($permission_seller);
        $seller6->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
       
        $seller7 = Seller::query()->create([
            'name' => 'البائع الثالث',
            'phone' => '1234567897',
            'location' => 'عنوان البائع',
            'seller_code' => '000003',
            'username' => mt_rand(10000000, 99999999),
            'store_number' => mt_rand(10000000, 99999999),
            'country_id' => 1,
            'description' => 'Seller Account Description',
            'app_version' => '1.0.0',
            'default_lang' => 'ar',
            'whatsapp_number' => '+9647502120571',
            'account_status' => SellerEnum::ACCEPTED->name,
            'hashed_login_otp' => Hash::make('123456789'),
            'governorate_id' => 1,
            'is_public_store' => 2,
            'device_token' => 'Device Token From Firebase',
            'seller_dynamic_link' => Helper::createDynamicLink('seller', 3, 'show_seller_screen'),
            'password' => Hash::make('123456789'),
            'plan_expired_at' => '2028-03-31',
            'current_points' => 100000,
        ]);
        $seller7->syncPermissions($permission_seller);
        $seller7->addMedia(public_path('logo.png'))->preservingOriginal()->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
        (new SellerServices())->handleProductQrCode($seller1);
        (new SellerServices())->handleProductQrCode($seller2);
        (new SellerServices())->handleProductQrCode($seller3);
    }
}
