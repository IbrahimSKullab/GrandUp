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
        Schema::create('shipping_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipping_company_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_transactions');
    }
};
