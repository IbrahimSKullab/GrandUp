<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('request_number_special', function (Blueprint $table) {

            $table->id();

            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('number');

            $table->string('status')->default('pending');
            $table->string('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {

    }
};
