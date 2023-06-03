<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1);
            $table->string('subscription_type');
            $table->integer('subscription_period');
            $table->double('points')->nullable();
            $table->boolean('is_free_subscription')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
