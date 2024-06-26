<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class usersFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'description' => fake()->description(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2a$12$JC50AgyN8SSXNOYOdb1DrebxcrVk6XzgTh5nLSKo2iPM8Lv9IQa/S',
            'username' => fake()->userName(),
            'telephone' => fake()->phoneNumber(),
            'city' => fake()->city(),
            'postcode' => fake()->postcode(),
            'role' => fake()->randomElement(['admin','user']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
