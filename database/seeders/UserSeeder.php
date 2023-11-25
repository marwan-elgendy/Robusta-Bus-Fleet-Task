<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
                'password' => 'password',
            ],
            [
                'name' => 'Test User2',
                'email' => 'testuser2@gmail.com',
                'password' => 'password'
            ],
            [  
                'name' => 'Test Admin',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'is_admin' => true
            ]
        ]);
    }
}
