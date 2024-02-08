<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\users;
use App\Models\autonomousCommunities;
use App\Models\regions;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Communities>
 */
class communitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $id_user= users::all()->pluck('id_user')->toArray();
        $id_autonomousCommunity= autonomousCommunities::all()->pluck('id_autonomousCommunity')->toArray();
        $id_region= regions::all()->pluck('id_region')->toArray();



        return [
            'id_admin' => $this->faker->randomElement($id_user) ?? users::factory()->create()->id_user,
            'name' => $this->faker->name(),
            'description' => fake()->description(),            
            'id_autonomousCommunity' => $this->faker->randomElement($id_autonomousCommunity),
            'id_region' => $this->faker->randomElement($id_region),
            'private' => true,
            'created_at' => now(),
            'isActive' => $this->faker->boolean()
        ];
    }
}
