<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::updateOrCreate(
            ['name' => 'Fitriyanto'],
            ['phone' => '081234567890', 'discount_percentage' => 10]
        );

        Member::updateOrCreate(
            ['name' => 'Budi Santoso'],
            ['phone' => '081234567891', 'discount_percentage' => 15]
        );

        Member::updateOrCreate(
            ['name' => 'Ani Wijaya'],
            ['phone' => '081234567892', 'discount_percentage' => 5]
        );
    }
}
