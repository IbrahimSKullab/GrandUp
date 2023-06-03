<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('agent_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('txn_id');
            $table->integer('points');
            $table->string('transaction_type');

            $table->boolean('is_added_points')->default(true);
            $table->boolean('credit_by_admin')->default(false);
            $table->string('point_added_by')->nullable();

            $table->string('from_phone')->nullable();
            $table->string('to_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent_transactions');
    }
};
