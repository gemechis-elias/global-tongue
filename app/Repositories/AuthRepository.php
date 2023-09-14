<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function register(array $data): User
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthdate' => "2020-12-15",
            'role' => "user",
            'level' => "beginner",
            'subscription_type' => "free",


        ];

        return User::create($data);
    }
}
