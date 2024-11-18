<?php

namespace Database\Factories;

use App\Models\PalletType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProcessPallet>
 */
class ProcessPalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "pallet_type_id" => PalletType::factory(),
            "block_id" => null,
            "height" => fake()->randomFloat(1,100,200),
            "support_weight" => fake()->randomFloat(1,100,200),
            "x_block" => fake()->randomFloat(1,100,200),
            "y_block" => fake()->randomFloat(1,100,200),
            "status" => 'draft',
        ];
    }
}
