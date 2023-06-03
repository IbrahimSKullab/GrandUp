<?php

use App\Enums\SellerEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('seller_product_id')->nullable()->constrained()->nullOnDelete();
            $table->float('product_price');
            $table->string('product_price_currency')->default(SellerEnum::ID->name);
            $table->boolean('is_ordinary_price')->default(0);
            $table->boolean('is_special_price')->default(0);
            $table->integer('qty');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
