<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\comments;
use App\Models\posts;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class commentsPostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_post' => posts::inRandomOrder()->first()->id, // Obtiene un id_post al azar
            'id_user' => User::inRandomOrder()->first()->id, // Obtiene un id_user al azar
            'comment' => $this->faker->text(),
        ];
    }
}
