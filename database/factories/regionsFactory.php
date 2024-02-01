<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\autonomousCommunities;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class regionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_autonomousCommunity = autonomousCommunities::all()->pluck('id')->toArray();

        return [
            'id_autonomousCommunity' => $this->faker->randomElement($id_autonomousCommunity),
            'name' => fake()->name()
        ];
    }
}
