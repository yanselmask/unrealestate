<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assigned_facilities>
 */
class AssignedFacilitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_type' => \App\Models\Facility::class,
            'model_id' => \App\Models\Facility::factory(),
            'property_id' => \App\Models\Property::factory()
        ];
    }
}
