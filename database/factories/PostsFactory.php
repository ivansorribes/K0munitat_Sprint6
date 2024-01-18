<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Communities;
use app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_community = Communities::all()->pluck('id_community')->toArray();
        $id_user = User::all()->pluck('id_user')->toArray();

        return [
            'id_community' => $this->faker->randomElement($id_community),
            'id_user' => $this->faker->randomElement($id_user),
            'title' => fake()->title(),
            'description' => fake()->description(),
            'category' => fake()->category(),
            'date_published' => now(),
            'isActive' => fake()->isActive(),
            'type' =>fake()->randomElement(['advertisment', 'post'])

        ];
    }
}
