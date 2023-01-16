<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $userData = [
            [
                'username' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 3
            ],
            [
                'username' => 'JohnDoe',
                'email' => 'affiliate@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 2
            ],
            [
                'username' => 'JaneDoe',
                'email' => 'user@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 1
            ],
        ];

        User::insert($userData);
    }
}
