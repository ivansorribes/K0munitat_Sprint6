<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\communities;
use app\Models\User;

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
        $id_community = communities::all()->pluck('id')->toArray();
        $id_user = User::all()->pluck('id')->toArray();

        $categories = ['Fruits', 'Vegetables', 'Material']; 


        return [
            'id_community' => $this->faker->randomElement($id_community),
            'id_user' => $this->faker->randomElement($id_user),
            'title' => fake()->title(),
            'description' => $this->faker->text(),
            'category' => $this->faker->randomElement($categories),
            'isActive' => $this->faker->boolean,
            'type' =>fake()->randomElement(['advertisment', 'post'])

        ];
    }
}
