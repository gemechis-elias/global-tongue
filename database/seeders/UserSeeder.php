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
        $data = [
           [ 'name' => 'Amanuel',
            'email' => 'aman@gmail.com',
            'password' => Hash::make('123456'),
            'birthdate' => '1990-01-01',
            'level' => 'beginner',
            'subscription_type' => 'free',

            'my_courses' => json_encode([]),
            'paid_courses' => json_encode([]),
            'completed_levels'=> json_encode([]),
            'completed_units'=> json_encode([]), 
            'completed_lessons'=> json_encode([]),
            'completed_exercises'=> json_encode([]),
            'completed_tips'=> json_encode([]),
            'completed_conversation'=> json_encode([]),
        ],
            [
            'name' => 'Gemechis',
            'email' => 'gemechis@gmail.com',
            'password' => Hash::make('123456'),
            'birthdate' => '1990-01-01',
            'level' => 'beginner',
            'subscription_type' => 'premium',
            
            'my_courses' => json_encode([]),
            'paid_courses' => json_encode([]),
            'completed_levels'=> json_encode([]),
            'completed_units'=> json_encode([]), 
            'completed_lessons'=> json_encode([]),
            'completed_exercises'=> json_encode([]),
            'completed_tips'=> json_encode([]),
            'completed_conversation'=> json_encode([]),

            ]
        ];

        User::create($data);

        // Testing Dummy User
        // User::factory(2)->create();
    }
}
