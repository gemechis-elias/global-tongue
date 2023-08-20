<?php

namespace Database\Seeders;

use App\Models\Course; 
use Illuminate\Database\Seeder; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class CourseSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete();
        $data = [
            [
                'name' => 'Spanish Level 1',
                'description' => 'Learn words and phrases for greetings and introductions, eating at a restaurant, shopping, family, and travel. Study professions, hobbies, pronunciation of -r versus -rr, and subject pronouns and learn when to use tú versus usted.',
                'tag' => 'Ser, Gender, Gustar, Estar, Plurals, "Ir" + "a"',
                'level' => 'Level 1',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
         
        ];
        Course::insert($data);

        Course::factory(2)->create();
    }
}
