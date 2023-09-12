<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */



    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(UnitSeeder::class); 
        $this->call(LessonSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(TipsSeeder::class);
        $this->call(ConversationSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProgressSeeder::class);




    }
}
