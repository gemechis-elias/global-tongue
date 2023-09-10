<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('exercises')->delete();
        //  Sample data from https://app.fluencia.com/
        $data = [
            [
                'course_id'=> 1,
                'level_id' => 1,
                'unit_id' => 1,
                'lesson_id'=> 1,
                'user_id' => 1,


                'exercise_type' => 'multiple_choice_no_audio',
                'instruction'=> 'Give it your best shot, even if you\'re not sure of the answer!',
                'question'=> 'Let\'s start with the basics. How do you say “hello” in Spanish?',
                'image' => "https://api.globaltongueedu.com/v1/public/images/exercises/image_1.jpg",
                'voice'=> null,
                'choices'=> '["Hola","Adiós","Buenos días","Buenas noches"]',
                'incorrect_hint'=> '¡Ups! The correct answer is hola. Hello in Spanish is hola, you can remember it easily because they both start with the letter -h! Curious about the other words? They mean goodbye (adiós), see you later (hasta luego), and my name is (me llamo). But we\'ll learn those in a second!',
                'correct_answer'=> '0',
                
            ],
            [
               
                'course_id'=> 1,
                'level_id' => 1,
                'unit_id' => 1,
                'lesson_id'=> 1,
                'user_id' => 1,

                'exercise_type' => 'multiple_choice_with_audio',
                'instruction'=> 'Give it your best shot, even if you\'re not sure of the answer!',
                'question'=> 'How do you say “goodbye” in Spanish?',
                'image' => "https://api.globaltongueedu.com/v1/public/images/exercises/image_1.jpg",
                'voice'=> "https://api.globaltongueedu.com/v1/public/voices/voice1.mp3",
                'choices'=> '["Adiós","Hola","Buenos días","Buenas noches"]',
                'incorrect_hint'=> '¡Ups! The correct answer is adiós. Goodbye in Spanish is adiós, you can remember it easily because it sounds like the English word “adios”! Curious about the other words? They mean hello (hola), good morning (buenos días), and good night (buenas noches). But we\'ll learn those in a second!',
                'correct_answer'=> '0',
                
            ],
           

        ];
        Exercise::insert($data);
    }
}
