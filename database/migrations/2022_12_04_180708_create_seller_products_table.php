<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained()->nullOnDelete();
            $table->json('title');
            $table->longText('description');
            $table->string('code')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('new_product')->default(0);
            $table->double('price')->nullable();
            $table->double('special_price')->nullable();
            $table->integer('points')->nullable();
            $table->unsignedInteger('popularity')->default(0);
            $table->string('product_dynamic_link')->nullable();

            $table->string('video_link')->nullable();

            $table->boolean('admin_approval')->default(0);
            $table->boolean('product_rejected')->default(0);
            $table->string('rejection_reason')->nullable();

            $table->string('features_one')->nullable();
            $table->string('features_two')->nullable();
            $table->string('features_three')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seller_products');
    }
};
