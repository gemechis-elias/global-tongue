<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Conversation; 

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('conversations')->delete();
        $data = [
            [
                'course_id'=> 1,
                'level_id' => 1,
                'unit_id' => 1,
                'lesson_id' => 1,
                'user_id' => 1,

                'instruction' => 'Listen and click to see the translations.',
                'conversations' => json_encode([
                    [
                        'sentence_1' => 'Hola, ¿cómo estás?',
                        'sentence_2' => 'Hello, how are you?',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Bien, gracias. ¿Y tú?',
                        'sentence_2' => 'Good, thanks. And you?',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Muy bien, gracias.',
                        'sentence_2' => 'Very good, thanks.',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Adiós.',
                        'sentence_2' => 'Goodbye.',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                ]),


            ],
            [
                'course_id'=> 1,
                'level_id' => 1,
                'unit_id' => 1,
                'lesson_id' => 2,
                'user_id' => 1,

                'instruction' => 'Listen and click to see the translations.',
                'conversations' => json_encode([
                    [
                        'sentence_1' => 'Hola, ¿cómo estás?',
                        'sentence_2' => 'Hello, how are you?',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Bien, gracias. ¿Y tú?',
                        'sentence_2' => 'Good, thanks. And you?',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Muy bien, gracias.',
                        'sentence_2' => 'Very good, thanks.',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                    [
                        'sentence_1' => 'Adiós.',
                        'sentence_2' => 'Goodbye.',
                        'voice_1' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                        'voice_2' => 'https://api.globaltongueedu.com/v1/public/voices/voice1.mp3',
                    ],
                ]),


            ],
            
        ];

        Conversation::insert($data);
    }
}
