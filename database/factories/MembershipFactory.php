<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Plan;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        'client_id'=> Client::inRandomOrder()->first()->id,
        'plan_id' => Plan::inRandomOrder()->first()->id,
        'status'=> fake()->randomElement([1,0]),
        ];
    }
}
