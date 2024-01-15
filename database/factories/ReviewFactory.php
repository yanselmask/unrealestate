<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stars' => rand(1, 5),
            'message' => fake()->sentence(),
            'user_id' => \App\Models\User::factory(),
            'property_id' => \App\Models\Property::factory(),
            'status' => rand(0, 3)
        ];
    }
}
