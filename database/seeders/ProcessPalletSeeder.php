<?php

namespace Database\Seeders;

use App\Models\ProcessPallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessPalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProcessPallet::factory()->count(15)->create();
    }
}
