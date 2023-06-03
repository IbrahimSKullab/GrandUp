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
        Schema::create('seller_log_administration_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_ads_slider_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_offer_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_exhibition_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('n_request_id')->nullable();
            $table->foreign('n_request_id')->references('id')->on('notification_requests')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->unsignedBigInteger('r_n_s_id')->nullable();
            $table->foreign('r_n_s_id')->references('id')->on('request_number_special')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->unsignedBigInteger('u_p_r_id')->nullable();
            $table->foreign('u_p_r_id')->references('id')->on('upload_product_requests')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('seller_log_administration_service');
    }
};
