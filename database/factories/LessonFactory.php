<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'content' => implode("\n\n", fake()->paragraphs()),
            'order' => fake()->numberBetween(1, 100),
            'is_premium' => fake()->boolean(),
            'publish' => fake()->boolean(),
        ];
    }
}
