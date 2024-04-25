<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\autonomousCommunities;
use App\Models\regions;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Communities>
 */
class CommunitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $id_user= User::all()->pluck('id')->toArray();
        $id_autonomousCommunity= autonomousCommunities::all()->pluck('id')->toArray();
        $id_region= regions::all()->pluck('id')->toArray();



        return [
            'id_admin' => $this->faker->randomElement($id_user),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),            
            'id_autonomousCommunity' => $this->faker->randomElement($id_autonomousCommunity),
            'id_region' => $this->faker->randomElement($id_region),
            'private' => true,
            'created_at' => now(),
            'isActive' => true,
        ];
    }
}
