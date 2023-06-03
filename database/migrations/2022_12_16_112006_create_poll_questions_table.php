<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('poll_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->json('title');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poll_questions');
    }
};
