<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;
use App\Models\communities;

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
        $id_community= communities::all()->pluck('id')->toArray();

        return [
            'id_community'=> $this->faker->randomElement($id_community),
            'id_user'=> $this->faker->randomElement($id_admin),
            'title'=> $this->faker->title(),
            'start'=> $this->faker->dateTimeThisMonth(),
            'end'=> $this->faker->dateTimeThisMonth(),
        ];
    }
}
