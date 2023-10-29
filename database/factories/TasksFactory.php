<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tasks::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'is_completed' => $this->faker->boolean,
            'task_list_id' => $this->faker->numberBetween(1, 10),
            'position' => $this->faker->numberBetween(0, 100),
            'start_on' => $this->faker->date,
            'due_on' => $this->faker->date,
            'open_subtasks' => $this->faker->numberBetween(0, 10),
            'comments_count' => $this->faker->numberBetween(0, 20),
            'is_important' => $this->faker->boolean,
        ];
    }
}
