<?php

use App\Enums\SellerEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('seller_code')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->foreignId('governorate_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_public_store')->default(false);
            $table->integer('order')->nullable();
            $table->string('default_currency')->default(SellerEnum::ID->name);
            $table->integer('current_points')->default(0);
            $table->boolean('is_subscribe_to_free_subscription')->default(false);
            $table->string('seller_dynamic_link')->nullable();

            $table->date('plan_expired_at')->nullable();
            $table->date('two_days_before_plan_expiration')->nullable();
            $table->date('one_days_before_plan_expiration')->nullable();

            $table->boolean('seller_notified_before_two_days')->default(false);
            $table->boolean('seller_notified_before_one_days')->default(false);
            $table->boolean('seller_notified_in_expiration_date')->default(false);

            $table->boolean('seller_notified_with_empty_points')->default(false);
            $table->boolean('seller_notified_with_points_doesnot_show')->default(false);

            $table->string('hashed_login_otp')->nullable();
            $table->string('password')->nullable();
            $table->boolean('enable_notification')->default(true);
            $table->string('account_status')->default(SellerEnum::REQUIRE_APPROVAL->name);
            $table->string('app_version')->nullable()->default('1.0.0');
            $table->string('device_type')->nullable()->default('android');
            $table->string('default_lang')->default('ar');
            $table->string('device_token')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
};
