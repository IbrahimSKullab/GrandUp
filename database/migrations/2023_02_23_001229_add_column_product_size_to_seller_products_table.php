<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('seller_products', function (Blueprint $table) {
            $table->integer('product_size')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('seller_products', function (Blueprint $table) {
            $table->dropColumn('product_size');
        });
    }
};
