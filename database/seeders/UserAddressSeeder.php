<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each existing user, create 1 primary + 1 random address
        User::all()->each(function (User $user) {
            // Primary address
            UserAddress::factory()->primary()->create([
                'user_id' => $user->id,
                'type'    => 'home',
            ]);

            // Secondary address (work)
            UserAddress::factory()->create([
                'user_id' => $user->id,
                'type'    => 'work',
            ]);
        });

        // Bonus: create a user with 5 addresses
        $user = User::factory()->create([
            'name'  => 'Multi Address User',
            'email' => 'multi@example.com',
        ]);

        UserAddress::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);
    }
}