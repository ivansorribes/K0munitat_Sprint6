<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\users;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comments>
 */
class commentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_user= users::all()->pluck('id_user')->toArray();

        return [
            'id_user' => $this->faker->randomElement($id_user),
            'comment' => fake()->comment()
        ];
    }
}
