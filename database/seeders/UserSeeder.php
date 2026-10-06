<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a fixed admin user
        User::factory()->admin()->create([
            'name'  => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create a fixed regular user
        User::factory()->create([
            'name'  => 'Regular User',
            'email' => 'user@example.com',
        ]);

        // Create 10 random users
        User::factory()->count(10)->create();

        // Create 3 inactive users
        User::factory()->count(3)->inactive()->create();
    }
}