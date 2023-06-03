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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('governorate_id')->nullable()->constrained()->nullOnDelete();
            $table->string('address')->nullable();
            $table->string('phone')->unique();
            $table->boolean('status')->default(1);
            $table->string('app_version')->default('1.0.0');
            $table->string('device_type')->default('android');
            $table->string('default_lang')->default('ar');
            $table->string('hashed_login_otp')->nullable();
            $table->string('device_token')->nullable();
            $table->string('current_points')->default(0);
            $table->boolean('enable_notification')->default(true);
            $table->boolean('enable_features_search')->default(true);
            $table->boolean('enable_viewing_points')->default(true);
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
        Schema::dropIfExists('users');
    }
};
