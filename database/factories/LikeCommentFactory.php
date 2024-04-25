<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\commentsPosts;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LikeCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_comment = commentsPosts::all()->pluck('id')->toArray();
        $id_user = User::all()->pluck('id')->toArray();


        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_comment' => commentsPosts::inRandomOrder()->first()->id,
        ];
    }
}
