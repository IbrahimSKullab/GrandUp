<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('upload_product_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->default('pending');
            $table->integer('points');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('upload_product_requests');
    }
};
