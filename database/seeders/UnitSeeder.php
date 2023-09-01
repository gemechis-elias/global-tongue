<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;  
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->delete();
        $data = [
            [
                'course_id' => 1,
                'unit_name' => 'Unit 1', 
                'unit_title' => 'Meetings and Greetings',
                'unit_description' => 'Learn the basic greetings you\'ll need to introduce yourself and have your first conversation, plus essential pronunciation of -ch, -h, -ll, and -ñ.',
                'unit_image' => null,
                'no_of_lessons' => 5,
                'user_id' => 1,

            ],
            [
                'course_id' => 1,
                'unit_name' => 'Unit 2', 
                'unit_title' => 'Let\'s Talk About You',
                'unit_description' => 'Explore subject pronouns, professions, and using "ser" for descriptions and origins. Learn pronunciation of vowels and when to use "tú" versus "usted."',
                'unit_image' => null,
                'no_of_lessons' => 8,
                'user_id' => 1,

            ],
            [
                'course_id' => 2,
                'unit_name' => 'Unit 1', 
                'unit_title' => 'Let\'s Talk About You',
                'unit_description' => 'Explore subject pronouns, professions, and using "ser" for descriptions and origins. Learn pronunciation of vowels and when to use "tú" versus "usted."',
                'unit_image' => null,
                'no_of_lessons' => 5,
                'user_id' => 1,

            ],
            
         
        ];
        Unit::insert($data);

     //   Unit::factory(1)->create();
    }
}
