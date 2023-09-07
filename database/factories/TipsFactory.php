<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tips>
 */
class TipsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

         // [
    //     'course_id',
    //     'level_id',
    //     'unit_id',
    //     'lesson_id',

    //     'title',
    //     'description',
    //     'cover_image',
    //     'language_1',
    //     'language_2',
    //     'sentence_1',
    //     'sentence_2',
    //     'voice_1',
    //     'voice_2',
    // ];
    public function definition()
    {

        return [
            'course_id' => random_int(1, 2),
            'level_id' => random_int(1, 2),
            'unit_id' => random_int(1, 2),
            'lesson_id' => random_int(1, 2),

            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'cover_image' => "https://d21gvxjpvoxtck.cloudfront.net/images/resized/465_310/business%20person%20giving%20a%20presentation%202.jpg",
            'language_1' => $this->faker->sentence,
            'language_2' => $this->faker->sentence,
            'sentence_1' => $this->faker->sentence,
            'sentence_2' => $this->faker->sentence,
            'voice_1' => "https://api.globaltongueedu.com/v1/public/voices/voice_course_1_level_1_unit_1_lesson_1_sentence_1.mp3",
            'voice_2' => "https://api.globaltongueedu.com/v1/public/voices/voice_course_1_level_1_unit_1_lesson_1_sentence_2.mp3",
        ];
    }
}
