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
       Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        // Menghubungkan transaksi dengan id PS di tabel consoles
        $table->foreignId('console_id')->constrained('consoles')->onDelete('cascade');
        
        $table->string('renter_name'); // Nama Penyewa
        $table->integer('duration');   // Durasi dalam hitungan JAM (misal: 1, 2, 3. Jika Los/Bebas diisi 0)
        $table->integer('total_price');// Total Harga Sewa
        $table->string('status')->default('belum_bayar'); // Status pembayaran: belum_bayar / lunas
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
