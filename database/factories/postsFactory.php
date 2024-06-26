<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\User;
use app\Models\categories;
use app\Models\communities;

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
        $id_user = User::all()->pluck('id')->toArray();
        $id_category = categories::all()->pluck('id')->toArray();
        $id_community = communities::all()->pluck('id')->toArray();



        return [
            'id_user' => $this->faker->randomElement($id_user),
            'id_category' => $this->faker->randomElement($id_category),
            'id_community' => $this->faker->randomElement($id_community),
            'title' => fake()->title(),
            'description' => $this->faker->text(),
            'isActive' => $this->faker->boolean,
            'private' => $this->faker->boolean,
            'type' => fake()->randomElement(['advertisement', 'post']),

        ];
    }
}
