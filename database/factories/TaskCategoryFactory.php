<?php

namespace Database\Factories;

use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskCategory>
 */
class TaskCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'user_id' => User::all()->random()->id,
        ];
    }
}
