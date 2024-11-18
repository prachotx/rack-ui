<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    use WithoutModelEvents;
    public function run()
    {
        $this->call([
            LocationSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
            RackSeeder::class,
            PalletTypeSeeder::class,
            PalletSeeder::class,
            ProductTypeSeeder::class,
            ProductSeeder::class,
            ProcessPalletSeeder::class,
        ]);
    }
}