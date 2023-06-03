<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('gift_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gift_order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('gift_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('points');
            $table->integer('qty');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gift_order_items');
    }
};
