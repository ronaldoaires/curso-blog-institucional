<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters because of foreign key constraints:
     * 1. Users       (independent)
     * 2. Categories  (independent, self-referencing)
     * 3. UserAddress (depends on users)
     * 4. Posts       (depends on users and categories)
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            UserAddressSeeder::class,
            PostSeeder::class,
        ]);
    }
}