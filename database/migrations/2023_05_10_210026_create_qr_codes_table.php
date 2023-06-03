<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();

            $table->string('code_number');
            $table->foreignId('qr_category_id')->nullable()->constrained('qr_categories')->nullOnDelete();
            $table->boolean('is_used')->default(false);

            $table->string('used_by')->nullable();
            $table->string('used_by_phone')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('used_at')->nullable();

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
        Schema::dropIfExists('qr_codes');
    }
};
