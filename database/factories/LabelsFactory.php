<?php

namespace Database\Factories;

use App\Models\Labels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Labels>
 */
class LabelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => $this->faker->hexColor,
            // Add other attributes and their values here
        ];
    }
}
