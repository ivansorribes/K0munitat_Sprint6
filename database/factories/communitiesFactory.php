<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\autonomousCommunities;
use App\Models\regions;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        // Get all autonomous communities
        $autonomousCommunities = autonomousCommunities::all();

        // Get a random autonomous community ID
        $randomAutonomousCommunityId = $this->faker->randomElement($autonomousCommunities->pluck('id')->toArray());

        // Get the regions associated with the randomly selected autonomous community
        $associatedRegions = autonomousCommunities::find($randomAutonomousCommunityId)->regions()->get();

        // Get the IDs of the associated regions
        $regionIds = $associatedRegions->pluck('id')->toArray();

        return [
            'id_admin' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),

            'name' => $this->faker->name(),

            'description' => $this->faker->text(),

            'id_autonomousCommunity' => $randomAutonomousCommunityId,

            'id_region' => $this->faker->randomElement($regionIds),

            'private' => true,

            'created_at' => now(),

            'isActive' => true,
        ];
    }
}
