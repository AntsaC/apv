<?php

use App\Enum\EnergyType;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->date('circulationDate')->nullable();
            $table->date('purchaseDate')->nullable();
            $table->date('lastEventDate')->nullable();
            $table->string('brand');
            $table->string('model', 20)->nullable();
            $table->string('version', 50)->nullable();
            $table->string('vin', 30)->unique();
            $table->string('immatriculation', 20)->unique();
            $table->integer('kilometrage');
            $table->enum('energy', [EnergyType::DIESEL->value, EnergyType::HYBRIDE->value, EnergyType::FUEL->value, EnergyType::PLUGIN->value])->nullable();
            $table->enum('saleType', ['VN', 'VO'])->nullable();
            $table->string('invoiceComment')->nullable();
            $table->string('saleFileNumber', 20);
            $table->date('eventDate')->nullable();
            $table->string('eventOrigin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
