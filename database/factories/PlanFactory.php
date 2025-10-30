<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
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
        'type' => fake()->randomElement(['Anual','Mensual']),
        'price' => fake()->randomFloat(1, 20, 30),
        'description' => fake()->text(100),
        ];
    }
}
