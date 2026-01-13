<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $exist = User::where('email', 'admin@example.com')->exist();

        if (!$exist) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'avatar' => 'images/prof-oak.png',
            ]);
        }
    }
}