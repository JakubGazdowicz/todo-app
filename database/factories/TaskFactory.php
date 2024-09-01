<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'description' => fake()->sentence(10),
            'duration_minutes' => fake()->numberBetween(60, 480),
            'user_id' => null,
            'task_category_id' => null,
        ];
    }
}
