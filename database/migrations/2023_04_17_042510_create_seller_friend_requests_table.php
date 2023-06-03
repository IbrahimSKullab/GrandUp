<?php

use App\Enums\FriedRequestEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_friend_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('store_seller_id')->nullable();
            $table->foreign('store_seller_id')->references('id')->on('sellers')->cascadeOnDelete()->cascadeOnUpdate();;

            $table->foreignId('seller_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('friendship_type')->default(FriedRequestEnum::ORDINARY->name);
            $table->boolean('friend_request_accepted_from_seller')->default(0);

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
        Schema::dropIfExists('seller_friend_requests');
    }
};
