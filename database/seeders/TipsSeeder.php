<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tips; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('tips')->delete();
        $data = [
            [
                'course_id'=> 1,
                'level_id' => 1,
                'unit_id' => 1,
                'lesson_id' => 1,
                'user_id' => 1,

                'title' => 'Let\'s keep going!',
                'description' => 'In less than 5 minutes you\'ll be ready to have your first conversation!Here are two basic phrases we\'ll practice next:',
                'language_1' => 'Spanish',
                'language_2' => 'English',
                'sentence_1' => 'Hola, ¿cómo estás?',
                'sentence_2' => 'Hello, how are you?',
                'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
               
                'image' => "https://api.globaltongueedu.com/v1/public/images/tips/image_1.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ],
            
        ];
        Tips::insert($data);
    }
}
