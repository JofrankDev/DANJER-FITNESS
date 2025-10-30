<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
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
        'user_id' => User::inRandomOrder()->first()->id,
        'address' => fake()->streetAddress(),
        'emergency_phone' => $this->faker->unique()->numberBetween(900000000, 999999999)
        ];
    }
}
