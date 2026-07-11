<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('kasir_name');
            $table->timestamp('jam_buka');
            $table->timestamp('jam_tutup')->nullable();
            $table->enum('status', ['buka', 'tutup'])->default('buka');
            $table->integer('total_transaksi')->default(0);
            $table->bigInteger('total_rental')->default(0);
            $table->bigInteger('total_kantin')->default(0);
            $table->bigInteger('total_diskon')->default(0);
            $table->bigInteger('grand_total')->default(0);
            $table->text('catatan_handover')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
