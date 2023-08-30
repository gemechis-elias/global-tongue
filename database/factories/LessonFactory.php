<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'unit_id' => random_int(1, 2), // Adjust the range based on your units
            'course_id' => random_int(1, 2), // Adjust the range based on your courses
            'lesson_title' => $this->faker->sentence,
            'lesson_type' => $this->faker->randomElement(['dialogue', 'image', 'voice' ]),
            'lesson_cover' => null,
        ];
    }
}
