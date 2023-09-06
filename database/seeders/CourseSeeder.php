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
                'name' => 'English For Begineer',
                'description' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'level' => 'Beginner',
                'type' => "free",
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'English For Intermediate',
                'description' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'level' => 'Intermediate',
                'type' => "free",
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'English For Advanced',
                'description' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'level' => 'Advanced',
                'type' => "free",
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
         
        ];
        Course::insert($data);

      //  Course::factory(2)->create();
    }
}
