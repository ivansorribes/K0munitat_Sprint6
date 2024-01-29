<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\posts;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\imagePost>
 */
class imagePostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_post = posts::all()->pluck('id_post')->toArray();

        return [
            'id_post' => $this->faker->randomElement($id_post),
            'name' => $this->faker->name(), 
            'front_page' => $this->faker->boolean
        ];
    }
}
