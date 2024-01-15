<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => fake()->name(),
            'email' => fake()->safeEmail(),
            'message' => fake()->sentence(),
            'user_id' => fake()->randomElement([\App\Models\User::factory(), null]),
            'read_at' => fake()->randomElement([now(), null])
        ];
    }
}
