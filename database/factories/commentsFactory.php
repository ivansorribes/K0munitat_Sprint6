<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $id_user = User::all()->pluck('id')->toArray();

        return [
            'id_user' => $this->faker->randomElement($id_user),
            'comment' => $this->faker->text()
        ];
    }
}
