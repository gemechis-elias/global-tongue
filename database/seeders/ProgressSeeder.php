<?php

namespace Database\Seeders;

use App\Models\Progress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('progress')->delete();
        $data = [
            [
                'user_id' => "1",
                'course_id' => "1",
                'lesson_id' => "1",
                'date_completed' => "Sep 12, 2023",
                'completed' => true
            ]
        ];
        Progress::insert($data);
    }
}
