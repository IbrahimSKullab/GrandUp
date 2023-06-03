<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_offers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('points');
            $table->integer('days');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_offers');
    }
};
