<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->id('lessons_id');
        // $table->unsignedBigInteger('unit_id')->comment('Unit ID');
        // $table->unsignedBigInteger('course_id')->comment('Course ID');
        // $table->string('lesson_title');
        // $table->string('lesson_type');
        // $table->string('lesson_cover')->nullable();
        // $table->unsignedBigInteger('user_id')->comment('Created By Admin');

        DB::table('lessons')->delete();
        $data = [
            [
                'lesson_id' => 1,
                'unit_id' => 1,
                'course_id' => 1,
                'user_id' => 1,

                'lesson_title' => 'Let\'s Meet Carlos and Ana!',
                'lesson_type' => 'dialogue',
                'lesson_cover' => null,

            ],
            [
                'lesson_id' => 2,
                'unit_id' => 1,
                'course_id' => 1,
                'user_id' => 1,

                'lesson_title' => 'Basic greetings and introductions',
                'lesson_type' => 'image',
                'lesson_cover' => null,
            ],
            [
                'lesson_id' => 3,
                'unit_id' => 1,
                'course_id' => 1,
                'user_id' => 1,
                'lesson_title' => 'Essential Pronunciation: -ch, -h, -ll, -ñ',
                'lesson_type' => 'voice',
                'lesson_cover' => null,
            ]
            ];
            Lesson::insert($data);
    }
}
