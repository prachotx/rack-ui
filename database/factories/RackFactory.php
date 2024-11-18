<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rack>
 */
class RackFactory extends Factory
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
            "name" => fake()->name(),
            "location_id" => Location::factory(),
            "rows" => 5,
            "columns" => 3,
            "depth" => 120,
            "status" => 'draft',
        ];
    }
}
