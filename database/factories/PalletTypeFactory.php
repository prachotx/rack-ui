<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PalletType>
 */
class PalletTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->ean8(),
            "depth" => fake()->randomFloat(1,100,200),
            "long" => fake()->randomFloat(1,100,200),
        ];
    }
}
