<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 root categories with 3 children each
        Category::factory()
            ->count(5)
            ->create()
            ->each(function (Category $parent) {
                Category::factory()
                    ->count(3)
                    ->childOf($parent)
                    ->create();
            });

        // Create 2 inactive root categories
        Category::factory()->count(2)->inactive()->create();
    }
}