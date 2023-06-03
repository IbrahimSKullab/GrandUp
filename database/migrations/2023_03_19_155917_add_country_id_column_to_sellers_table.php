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
        Schema::table('sellers', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->after('whatsapp_number')->constrained()->nullOnDelete();
            $table->string('username')->nullable()->after('location');
            $table->string('store_number')->unique()->nullable()->after('governorate_id');
            $table->json('store_gps_location')->nullable()->after('store_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            //
        });
    }
};
