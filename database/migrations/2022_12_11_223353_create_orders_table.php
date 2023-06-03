<?php

use App\Enums\OrderEnum;
use App\Enums\SellerEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->float('total_cost');
            $table->integer('total_qty');
            $table->string('total_cost_currency')->default(SellerEnum::ID->name);
            $table->string('status')->default(OrderEnum::NEW_ORDER->name);
            $table->integer('points')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
