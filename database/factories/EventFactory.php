<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array 
    {

        $id_admin= User::all()->pluck('id')->toArray();

        return [
            'id_user'=> $this->faker->randomElement($id_admin),
            'title'=> $this->faker->title(),
            'start'=> $this->faker->dateTimeThisMonth(),
            'end'=> $this->faker->dateTimeThisMonth(),
        ];
    }
}
