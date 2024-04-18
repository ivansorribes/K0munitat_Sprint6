<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\commentsPosts;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReplyComment>
 */
class ReplyCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reply' => $this->faker->text(),
            'id_user' => User::inRandomOrder()->first()->id,
            'id_comment' => commentsPosts::inRandomOrder()->first()->id,
        ];
    }
}
