<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\posts;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class likesPostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_post = posts::all()->pluck('id')->toArray();
        $id_user = User::all()->pluck('id')->toArray();


        return [
            'id_user' => $this->faker->randomElement($id_user),
            'id_post' => $this->faker->randomElement($id_post),
        ];
    }
}
