<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('vn_seller_id')->nullable()->constrained('sellers')->onDelete('set null');
            $table->foreignId('vo_seller_id')->nullable()->constrained('sellers')->onDelete('set null');
            $table->foreignId('intermediate_seller_id')->nullable()->constrained('sellers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['vn_seller_id']);
            $table->dropForeign(['vo_seller_id']);
            $table->dropForeign(['intermediate_seller_id']);
        });

        Schema::dropIfExists('sellers');
    }
};
