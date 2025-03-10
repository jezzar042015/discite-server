<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(20),
            'description' => fake()->text(100),
            'level' => fake()->randomElement(['BEGINNER', 'INTERMEDIATE', 'ADVANCED']),
            'is_premium' => fake()->boolean(),
            'publish' => fake()->boolean(),
        ];
    }
}
