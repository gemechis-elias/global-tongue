<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = 
          [
            [
             'name' => 'Amanuel',
            'email' => 'aman@gmail.com',
            'password' => Hash::make('123456'),
            'birthdate' => '1990-01-01',
            'role' => 'user',
            'level' => 'beginner',
            'subscription_type' => 'free',

            'my_courses' => [],
            'paid_courses' => [],
            'completed_levels'=> [],
            'completed_units'=> [], 
            'completed_lessons'=> [],
            'completed_exercises'=> [],
            'completed_tips'=> [],
            'completed_conversation'=> []
            ],

            [
                'name' => 'Gemechis',
               'email' => 'gemechis@gmail.com',
               'password' => Hash::make('123456'),
               'birthdate' => '1990-01-01',
               'role' => 'user',
               'level' => 'beginner',
               'subscription_type' => 'premium',
   
               'my_courses' => [],
               'paid_courses' => [],
               'completed_levels'=> [],
               'completed_units'=> [], 
               'completed_lessons'=> [],
               'completed_exercises'=> [],
               'completed_tips'=> [],
               'completed_conversation'=> []
            ],

            [
               'name' => 'Admin',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('123456'),
               'birthdate' => '1990-01-01',
               'role' => 'admin',
               'level' => 'beginner',
               'subscription_type' => 'premium',
   
               'my_courses' => [],
               'paid_courses' => [],
               'completed_levels'=> [],
               'completed_units'=> [], 
               'completed_lessons'=> [],
               'completed_exercises'=> [],
               'completed_tips'=> [],
               'completed_conversation'=> []
               ]
          
        ];

        foreach ($data as &$user) {
            // Decode JSON-encoded fields
            $user['my_courses'] = json_encode($user['my_courses']);
            $user['paid_courses'] = json_encode($user['paid_courses']);
            $user['completed_levels'] = json_encode($user['completed_levels']);
            $user['completed_units'] = json_encode($user['completed_units']);
            $user['completed_lessons'] = json_encode($user['completed_lessons']);
            $user['completed_exercises'] = json_encode($user['completed_exercises']);
            $user['completed_tips'] = json_encode($user['completed_tips']);
            $user['completed_conversation'] = json_encode($user['completed_conversation']);
        }

        User::insert($data);

        // Testing Dummy User
        // User::factory(2)->create();
    }
}
