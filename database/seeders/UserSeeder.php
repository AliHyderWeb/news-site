<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Ali',
            'last_name' => 'Hyder',
            'email' => 'admin@gmail.com',
            'password' => '12345',
            'role' => 'admin',
        ]);

        User::create([
            'first_name' => 'Mozam',
            'last_name' => 'laghari',
            'email' => 'user@gmail.com',
            'password' => '12345',
            'role' => 'user',
        ]);
    }
}
