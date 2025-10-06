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
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'username' => 'operator',
            'password' => Hash::make('operator123'),
            'role' => 'Operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'username' => 'user1',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
