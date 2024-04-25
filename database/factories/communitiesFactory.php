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
            // Assign a random user ID as the admin
            'id_admin' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),

            // Assign a random name
            'name' => $this->faker->name(),

            // Assign a random description
            'description' => $this->faker->text(),

            // Assign the randomly selected autonomous community ID
            'id_autonomousCommunity' => $randomAutonomousCommunityId,

            // Assign a random region ID from the associated regions
            'id_region' => $this->faker->randomElement($regionIds),

            // Set the community as private
            'private' => true,

            // Set the creation time to the current time
            'created_at' => now(),

            // Set the community as active
            'isActive' => true,
        ];
    }
}