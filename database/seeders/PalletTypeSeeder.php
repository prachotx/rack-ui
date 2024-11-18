<?php

namespace Database\Seeders;

use App\Models\PalletType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PalletType::factory()->count(5)->create();
    }
}
