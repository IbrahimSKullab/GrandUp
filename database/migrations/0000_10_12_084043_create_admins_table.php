<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('device_token')->nullable();
            $table->boolean('status')->default(1);
            $table->date('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('is_staff')->default(false);

            $table->boolean('is_agent')->default(false);
            $table->boolean('is_pos')->default(false);

            $table->integer('agent_current_points')->nullable();
            $table->integer('pos_current_points')->nullable();

            $table->string('address')->nullable();

            $table->foreignId('governorate_id')->nullable()->constrained()->nullOnDelete();

            $table->string('default_lang')->default('ar');

            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
