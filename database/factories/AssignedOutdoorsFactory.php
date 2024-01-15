<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignedOutdoors>
 */
class AssignedOutdoorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => \App\Models\Property::factory(),
            'facility_id' => \App\Models\Outdoor::factory(),
            'distance' => rand(0, 10),
            'distance_type' => fake()->randomElement(['km', 'mt', 'mile'])
        ];
    }
}
