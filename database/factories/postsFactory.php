<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\communities;
use app\Models\users;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class postsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_community = communities::all()->pluck('id_community')->toArray();
        $id_user = users::all()->pluck('id_user')->toArray();

        return [
            'id_community' => $this->faker->randomElement($id_community),
            'id_user' => $this->faker->randomElement($id_user),
            'title' => fake()->title(),
            'description' => fake()->description(),
            'category' => fake()->category(),
            'isActive' => fake()->isActive(),
            'type' =>fake()->randomElement(['advertisment', 'post'])

        ];
    }
}
