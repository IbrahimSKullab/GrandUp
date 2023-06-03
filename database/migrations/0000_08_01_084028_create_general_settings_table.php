<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');

            $table->string('first_email')->nullable();
            $table->string('second_email')->nullable();
            $table->string('first_phone')->nullable();
            $table->string('second_phone')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('snapchat_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('tiktok_link')->nullable();

            $table->string('fcm_key')->nullable();
            $table->string('firebase_api_key')->nullable();
            $table->string('firebase_auth_domain')->nullable();
            $table->string('firebase_database_url')->nullable();
            $table->string('firebase_project_id')->nullable();
            $table->string('firebase_storage_bucket')->nullable();
            $table->string('firebase_messaging_sender_id')->nullable();
            $table->string('firebase_app_id')->nullable();

            // Firebase Dynamic Link Settings
            $table->string('dynamic_link')->nullable();
            $table->string('android_package_name')->nullable();
            $table->string('ios_package_name')->nullable();
            $table->string('ios_store_id')->nullable();

            $table->string('app_version')->default('1.0.0');

            $table->string('google_play_link')->nullable();
            $table->string('apple_store_link')->nullable();

            $table->string('vonage_api_key')->nullable();
            $table->string('vonage_api_secret')->nullable();
            $table->string('vonage_brand_name')->nullable();
            $table->string('vonage_whatsapp_from_number')->nullable();

            $table->integer('minimum_days_of_offer')->default(2);
            $table->integer('maximum_days_of_offer')->default(30);
            $table->double('offer_point_for_each_day')->default(50);

            $table->integer('minimum_days_of_slider')->default(2);
            $table->integer('maximum_days_of_slider')->default(30);
            $table->double('slider_point_for_each_day')->default(50);

            $table->integer('minimum_points_to_view_points_in_products')->default(500);

            $table->integer('upload_product_points')->default(500);

            $table->longText('seller_registration_content')->nullable();
            $table->boolean('enable_seller_page')->default(true);

            $table->boolean('default_value_of_features_search')->default(true);
            $table->boolean('default_value_of_viewing_points')->default(true);

            $table->string('seller_android_app_link')->nullable();
            $table->string('seller_ios_app_link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
