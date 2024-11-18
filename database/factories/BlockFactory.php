<?php

namespace Database\Factories;

use App\Models\Rack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "code" => fake()->ean8(),
            "rack_id" => Rack::factory(),
            "depth" => fake()->randomFloat(1,100,200),
            "long" => fake()->randomFloat(1,100,200),
            "height" => fake()->randomFloat(1,100,200),
            "row_position" => fake()->randomDigitNot(0),
            "column_position" => fake()->randomDigitNot(0),
            "support_weight" => fake()->randomFloat(1,100,200),
            "top_process_pallet_id" => null,
            "under_process_pallet_id" => null,
        ];
    }
}
