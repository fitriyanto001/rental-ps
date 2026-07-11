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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('console_id')->constrained('consoles')->onDelete('restrict'); 
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('set null');
            $table->enum('billing_type', ['paket', 'open_billing']);
            $table->integer('initial_hours')->default(0);
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->dateTime('actual_end_time')->nullable();
            $table->enum('checkout_scenario', ['A', 'B'])->nullable();
            $table->integer('rental_cost')->default(0);
            $table->enum('status', ['berjalan', 'selesai', 'dibatalkan'])->default('berjalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
