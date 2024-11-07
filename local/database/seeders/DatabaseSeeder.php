<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => 'Client User',
                'email' => 'client@example.com',
                'user_type' => 1, // client
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Coworker User',
                'email' => 'coworker@example.com',
                'user_type' => 2, // coworker
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'user_type' => 3, // admin
                'password' => bcrypt('12345678'),
            ],
        ];

        // Iterate through the users array and create each user
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}