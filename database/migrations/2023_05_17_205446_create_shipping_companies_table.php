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
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique()->nullable();

            $table->integer('current_points')->default(0);
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
        Schema::dropIfExists('shipping_companies');
    }
};
