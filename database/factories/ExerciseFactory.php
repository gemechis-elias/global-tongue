<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { 
        // $table->unsignedBigInteger('unit_id')->comment('Unit ID');
        // $table->unsignedBigInteger('course_id')->comment('Course ID');
        // $table->unsignedBigInteger('lesson_id')->comment('Lesson ID');
        // $table->string('exercise_type');
        // $table->string('instruction');
        // $table->string('question');
        // $table->string('image');
        // $table->string('voice');
        // $table->string('choices');
        // $table->string('incorrect_hint');
        // $table->string('correct_answer'); 
        return [
            'unit_id' => random_int(1, 2),  
            'course_id' => random_int(1, 2),  
            'lesson_id'=> random_int(1, 2),
            'exercise_type' => $this->faker->word,
            'instruction'=> $this->faker->sentence,
            'question'=> $this->faker->sentence,
            'image'=> "https://media.istockphoto.com/id/1280356530/photo/smiling-indian-latin-deaf-disabled-child-school-girl-learning-online-class-on-laptop.jpg?s=2048x2048&w=is&k=20&c=yq72bMVEhpfP1qGta9QqFJ5SjR0TxKi7uT4BCMj7A7k=",
            'voice'=> "http://codeskulptor-demos.commondatastorage.googleapis.com/descent/background%20music.mp3",
            'choices'=> "[\"A\",\"B\",\"C\",\"D\"]",
            'incorrect_hint'=> $this->faker->sentence,
            'correct_answer'=> "0",
        ];
    }
}
