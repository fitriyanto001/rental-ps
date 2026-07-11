<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuKantin;

class MenuKantinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuKantin::updateOrCreate(
            ['nama_menu' => '🍜 Indomie Goreng'],
            ['kategori' => 'Makanan', 'harga' => 8000, 'stok' => 20, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '🍜 Indomie Goreng + Telur'],
            ['kategori' => 'Makanan', 'harga' => 10000, 'stok' => 15, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '🥤 Es Teh Manis'],
            ['kategori' => 'Minuman', 'harga' => 3000, 'stok' => 50, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '☕ Kopi Hitam'],
            ['kategori' => 'Minuman', 'harga' => 5000, 'stok' => 30, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '☕ Kopi Susu'],
            ['kategori' => 'Minuman', 'harga' => 6000, 'stok' => 25, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '🍟 Kentang Goreng'],
            ['kategori' => 'Makanan', 'harga' => 7000, 'stok' => 10, 'status' => 'Tersedia']
        );

        MenuKantin::updateOrCreate(
            ['nama_menu' => '🥔 Keripik Singkong'],
            ['kategori' => 'Makanan', 'harga' => 4000, 'stok' => 0, 'status' => 'Habis']
        );
    }
}
