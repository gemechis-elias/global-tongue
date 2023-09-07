<?php

namespace Database\Seeders;

use App\Models\Level; 
use Illuminate\Database\Seeder; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class LevelSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();
        $data = [
            [
                'course_id'=> 1,
                'user_id' => 1,

                'name' => 'Begineer Level 1',
                'description' => 'Learn words and phrases for greetings and introductions, eating at a restaurant, shopping, family, and travel. Study professions, hobbies, pronunciation of -r versus -rr, and subject pronouns and learn when to use tú versus usted.',
                'tag' => 'Ser, Gender, Gustar, Estar, Plurals, "Ir" + "a"',
                'level' => 'Level 1',
                'type' => "free",
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'course_id'=> 1,
                'user_id' => 1,
                'name'=> 'Begineer Level 2',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 2',
                'type' => "free",

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'course_id'=> 1,
                'user_id' => 1,
                'name'=> 'Begineer Level 3',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 3',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()

            ],
            [
                'course_id'=> 1,
                'user_id' => 1,
                'name'=> 'Begineer Level 4',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 4',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()

            ],
            [
                'course_id'=> 2,
                'user_id' => 1,
                'name'=> 'Intermediate Level 1',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 1',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ],
            [
                'course_id'=> 2,
                'user_id' => 1,
                'name'=> 'Intermediate Level 2',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 2',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ],
            [
                'course_id'=> 2,
                'user_id' => 1,
                'name'=> 'Intermediate Level 3',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 3',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ],
            [
                'course_id'=> 3,
                'user_id' => 1,
                'name'=> 'Advanced Level 1',
                'description' => 'Learn words and phrases for talking about your home, family, pets, daily routines, and activities at a hotel. Study the present tense of regular verbs, reflexive verbs, and the present progressive tense.',
                'tag' => 'Present Tense, Reflexive Verbs, Present Progressive, Prepositions, Possessive Adjectives, Direct Object Pronouns',
                'level' => 'Level 1',
                'type' => "free",
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ]
         
        ];
        Level::insert($data);

      //  Level::factory(1)->create();
    }
}
