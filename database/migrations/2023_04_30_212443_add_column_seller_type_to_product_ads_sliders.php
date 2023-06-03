<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_ads_sliders', function (Blueprint $table) {
            $table->string('seller_type')->after('id')->default('general');  // type => general, private
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_ads_sliders', function (Blueprint $table) {
            //
        });
    }
};
