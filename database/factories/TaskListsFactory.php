<?php

namespace Database\Factories;

use App\Models\TaskLists;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskLists>
 */
class TaskListsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'open_tasks' => $this->faker->numberBetween(0, 10),
            'completed_tasks' => $this->faker->numberBetween(0, 10),
            'position' => $this->faker->numberBetween(0, 100),
            'is_completed' => $this->faker->boolean,
            'is_trashed' => $this->faker->boolean,
        ];
    }
}
