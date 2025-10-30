<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Membership;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
        'membership_id' => Membership::inRandomOrder()->first()->id,
        'amount' =>fake()->randomFloat(1, 20, 30),
        'payment_date' => fake()->date()
        ];
    }
}
