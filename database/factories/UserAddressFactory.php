<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(), // auto-create a user if not provided
            'type'         => fake()->randomElement(['home', 'work', 'other']),
            'zip_code'     => fake()->postcode(),
            'state'        => fake()->randomElement(['SP', 'RJ', 'MG', 'RS', 'BA', 'PR']),
            'city'         => fake()->city(),
            'street'       => fake()->streetName(),
            'number'       => (string) fake()->buildingNumber(),
            'complement'   => fake()->optional()->secondaryAddress(),
            'neighborhood' => fake()->word(),
            'is_active'    => true,
            'is_primary'   => false,
        ];
    }

    /**
     * Indicate that the address is the primary one.
     */
    public function primary(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_primary' => true,
        ]);
    }

    /**
     * Indicate that the address is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}