<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('sub_category_governorate', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sub_category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('governorate_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_category_governorate');
    }
};
