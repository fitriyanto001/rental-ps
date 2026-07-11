<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ConsoleSeeder::class,
            MenuKantinSeeder::class,
            MemberSeeder::class,
        ]);

        // Seed admin user
        \App\Models\User::updateOrCreate(
            ['email' => 'fitri@yanto.com'],
            [
                'name'     => 'Fitriyanto',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        // Seed guest/tamu user
        \App\Models\User::updateOrCreate(
            ['email' => 'tamu@ajisps.com'],
            [
                'name'     => 'Dosen Penilai / Tamu',
                'password' => \Illuminate\Support\Facades\Hash::make('tamu123'),
            ]
        );
    }
}
