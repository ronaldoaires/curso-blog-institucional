<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);

        return [
            'user_id'       => User::factory(),      // auto-create user if not provided
            'category_id'   => Category::factory(),  // auto-create category if not provided
            'slug'          => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 99999),
            'cover'         => null,
            'title'         => $title,
            'content'       => fake()->paragraphs(5, true),
            'is_active'     => true,
            'author'        => fake()->name(),
            'views'         => fake()->numberBetween(0, 10000),
            'last_visit_at' => fake()->optional()->dateTimeThisMonth(),
        ];
    }

    /**
     * Indicate that the post is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the post has no author user.
     */
    public function withoutUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => null,
        ]);
    }

    /**
     * Indicate that the post has no category.
     */
    public function withoutCategory(): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => null,
        ]);
    }
}