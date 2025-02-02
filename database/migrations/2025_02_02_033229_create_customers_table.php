<?php

use App\Enum\CivilityType;
use App\Enum\CustomerType;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cardNumber')->unique();
            $table->enum('civility', [CivilityType::Mr->value, CivilityType::Mme->value, CivilityType::Company->value, CivilityType::Garage->value])->nullable();
            $table->string('firstName', 50)->nullable();
            $table->string('lastName', 50)->nullable();
            $table->string('address')->nullable();
            $table->string('additionnalAdress')->nullable();
            $table->string('city', 100);
            $table->string('homePhone', 20)->nullable();
            $table->string('portablePhone', 20)->nullable();
            $table->string('jobPhone', 20)->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('type', [CustomerType::INDIVIDUAL->value, CustomerType::COMPANY->value])->default(CustomerType::INDIVIDUAL->value);
            $table->timestamps();
            $table->foreignId('business_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->foreignId('event_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->foreignId('last_event_account_id')->nullable()->constrained('accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['business_account_id']);
            $table->dropForeign(['event_account_id']);
            $table->dropForeign(['last_event_account_id']);
        });

        Schema::dropIfExists('customers');
    }
};
