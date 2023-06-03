<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('agent_pos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agent_id')->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pos_id')->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_pos');
    }
};
