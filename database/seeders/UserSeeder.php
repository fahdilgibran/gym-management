<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Gym',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Staff
        User::create([
            'name' => 'Staff Trainer',
            'email' => 'staff@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        // Member contoh
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);
    }
}