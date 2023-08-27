<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_id' => \App\Models\Course::factory(),
            'unit_name' => $this->faker->word,
            'unit_title' => $this->faker->sentence,
            'unit_description' => $this->faker->paragraph,
            'unit_image' => null,
            'no_of_lessons' => $this->faker->numberBetween(1, 10),
        ];
    }
}
