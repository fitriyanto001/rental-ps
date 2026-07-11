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
        Schema::create('menu_kantin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->string('kategori'); // Makanan / Minuman / Snak
            $table->integer('harga');
            $table->integer('stok')->default(0);
            $table->string('status')->default('Tersedia'); // Tersedia / Habis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_kantin');
    }
};
