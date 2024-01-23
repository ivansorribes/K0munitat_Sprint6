<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\comments;
use App\Models\posts;

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
        $id_post= posts::all()->pluck('id_post')->toArray();
        $id_comment= comments::all()->pluck('id_comment')->toArray();


        return [
            'id_post' => $this->faker->randomElement($id_post),
            'id_comment' => $this->faker->randomElement($id_comment),
        ];
    }
}
