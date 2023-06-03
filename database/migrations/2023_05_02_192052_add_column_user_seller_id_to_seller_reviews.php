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
        Schema::table('seller_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_seller_id')->after('user_id')->nullable();
            $table->foreign('user_seller_id')->references('id')->on('sellers')->cascadeOnDelete()->cascadeOnUpdate();;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_reviews', function (Blueprint $table) {
            //
        });
    }
};
