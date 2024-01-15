<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
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
            'code' => fake()->currencyCode(),
            'symbol' => fake()->randomElement(['$', '€']),
            'format' => '$1,0.00',
            'exchange_rate' => '1.00000000',
            'active' => 1
        ];
    }
}
