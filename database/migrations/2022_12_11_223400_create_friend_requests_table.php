<?php

use App\Enums\FriedRequestEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('friendship_type')->default(FriedRequestEnum::ORDINARY->name);
            $table->boolean('friend_request_accepted_from_seller')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('friend_requests');
    }
};
