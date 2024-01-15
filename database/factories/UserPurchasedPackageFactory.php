<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPurchasedPackage>
 */
class UserPurchasedPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_type' => \App\Models\User::class,
            'model_id' => \App\Models\User::factory(),
            'package_id' => \App\Models\Package::factory(),
            'start_at' => fake()->randomElement([now(), now()->subDays(rand(1, 40)), now()->addDays(rand(1, 40))]),
            'end_at' => fake()->randomElement([now(), now()->subDays(rand(1, 40)), now()->addDays(rand(1, 40))]),
            'canceled_at' => fake()->randomElement([now(), null]),
            'used_listing' => rand(0, 3),
            'used_ads' => rand(0, 3)
        ];
    }
}
