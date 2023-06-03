<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('charging_cards', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pos_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();

            $table->string('card_number');
            $table->integer('points');
            $table->boolean('is_used')->default(false);
            $table->string('transaction_id');
            $table->double('price');

            $table->string('used_by')->nullable();
            $table->string('used_by_phone')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('charging_cards');
    }
};
