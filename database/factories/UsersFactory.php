<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'password' => bcrypt('your_password_here'),
            'avatar_url' => $this->faker->imageUrl(200, 200, 'people'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
