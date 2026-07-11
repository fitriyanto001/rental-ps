<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Console::updateOrCreate(
            ['name' => 'PS4 - 01'],
            ['type' => 'PS4', 'status' => 'tersedia']
        );

        \App\Models\Console::updateOrCreate(
            ['name' => 'PS4 - 02'],
            ['type' => 'PS4', 'status' => 'tersedia']
        );

        \App\Models\Console::updateOrCreate(
            ['name' => 'PS4 - 03'],
            ['type' => 'PS4', 'status' => 'tersedia']
        );

        \App\Models\Console::updateOrCreate(
            ['name' => 'PS5 - 01'],
            ['type' => 'PS5', 'status' => 'tersedia']
        );
    }
}
