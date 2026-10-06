<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users      = User::all();
        $categories = Category::all();

        // Safety check: avoid errors if seeders ran out of order
        if ($users->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // Create 30 posts distributed among existing users and categories
        Post::factory()
            ->count(30)
            ->recycle($users)      // reuse existing users
            ->recycle($categories) // reuse existing categories
            ->create();

        // Create 5 posts without user (orphan posts)
        Post::factory()
            ->count(5)
            ->withoutUser()
            ->recycle($categories)
            ->create();

        // Create 5 posts without category
        Post::factory()
            ->count(5)
            ->withoutCategory()
            ->recycle($users)
            ->create();

        // Create 3 inactive posts
        Post::factory()
            ->count(3)
            ->inactive()
            ->recycle($users)
            ->recycle($categories)
            ->create();
    }
}