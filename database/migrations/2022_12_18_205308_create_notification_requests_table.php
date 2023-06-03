<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('notification_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_product_id')->constrained('seller_products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('date')->nullable();
            $table->integer('number_of_notification');
            $table->integer('points');
            $table->string('status')->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->string('notes')->nullable();

            $table->boolean('notification_sending_process_completed')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_requests');
    }
};
