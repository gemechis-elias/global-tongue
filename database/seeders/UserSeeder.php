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
            'name' => 'Amanuel',
            'email' => 'aman@gmail.com',
            'password' => Hash::make('123456'),
            'birthdate' => '1990-01-01',
            'level' => 'beginner',
            'subscription_type' => 'free',
            'my_courses' => json_encode([1, 2, 3]), // Sample course IDs as an array
        ];

        User::create($data);

        // Testing Dummy User
        // User::factory(2)->create();
    }
}
