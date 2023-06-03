<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained()->nullOnDelete();
            $table->string('txn_id');
            $table->integer('points');
            $table->string('transaction_type');
            $table->string('card_number')->nullable();

            $table->boolean('is_added_points')->default(false);
            $table->string('point_added_by')->nullable();

            $table->boolean('credit_by_admin')->default(false);

            $table->string('from_phone')->nullable();
            $table->string('to_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
};
