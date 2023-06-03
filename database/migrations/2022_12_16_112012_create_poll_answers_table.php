<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('poll_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('poll_question_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poll_answers');
    }
};
