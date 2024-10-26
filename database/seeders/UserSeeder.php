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
        $users = [
            [
                'name' => 'John',
                'email' => 'john@test.com',
                'password' => Hash::make('John123'),
            ],
            [
                'name' => 'Mary',
                'email' => 'mary@test.com',
                'password' => Hash::make('Mary123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }        
    }
}
