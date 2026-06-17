<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'role' => 'owner',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        
    }
}
