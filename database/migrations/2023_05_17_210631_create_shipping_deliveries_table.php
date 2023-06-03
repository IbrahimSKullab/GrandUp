<?php

use App\Enums\ShippingEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_company_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('phone')->unique()->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('governorate_id')->nullable()->constrained()->nullOnDelete();
            $table->string('account_active')->default(ShippingEnum::ACTIVE->name);
            $table->string('account_status')->default(ShippingEnum::REQUIRE_APPROVAL->name);
            $table->string('app_version')->default('1.0.0');
            $table->string('device_type')->default('android');
            $table->string('default_lang')->default('ar');
            $table->string('hashed_login_otp')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();

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
        Schema::dropIfExists('shipping_deliveres');
    }
};
