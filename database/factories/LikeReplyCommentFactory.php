<?php

namespace Database\Factories;

use App\Models\ReplyComment;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikeReplyComment>
 */
class LikeReplyCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_comment = ReplyComment::all()->pluck('id')->toArray();
        $id_user = User::all()->pluck('id')->toArray();


        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_reply' => ReplyComment::inRandomOrder()->first()->id,
        ];
    }
}
