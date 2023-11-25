<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Insert([
            [
                'name' => 'Test User',
                'email' => 'testuser@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
            [
                'name' => 'Test User2',
                'email' => 'testuser2@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => false
            ],
            [  
                'name' => 'Test Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => true
            ]
        ]);
    }
}
