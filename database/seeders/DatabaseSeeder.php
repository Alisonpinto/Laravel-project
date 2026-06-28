<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(['email' => 'admin@fcrit.ac.in'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Faculty
        User::updateOrCreate(['email' => 'faculty@fcrit.ac.in'], [
            'name' => 'Faculty Member',
            'password' => Hash::make('password'),
            'role' => 'faculty',
        ]);

        // Create Student
        User::updateOrCreate(['email' => 'student@fcrit.ac.in'], [
            'name' => 'Student User',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
