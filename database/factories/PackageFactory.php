<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'short_name' => fake()->randomElement(['FREE', 'PREMIUM', 'STANDARD']),
            'interval' => fake()->randomElement(['day', 'week', 'month', 'year']),
            'duration' => rand(1, 31),
            'listing_limit' => rand(0, 50),
            'ads_limit' => rand(0, 50),
            'is_recommended' => rand(0, 1),
            'status' => rand(0, 1)
        ];
    }
}
