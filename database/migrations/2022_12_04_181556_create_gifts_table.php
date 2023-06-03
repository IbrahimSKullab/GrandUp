<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('points');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gifts');
    }
};
