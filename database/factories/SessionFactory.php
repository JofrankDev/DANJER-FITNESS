<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trainer;
use App\Models\Room;
use App\Models\ClassType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'trainer_id' => Trainer::inRandomOrder()->first()->id,
        'room_id' => Room::inRandomOrder()->first()->id,
        'class_type_id' => ClassType::inRandomOrder()->first()->id,
        'name' => fake()->word(),
        'description' => fake()->text(25),
        'capacity'=> function(array $attributes){
                return Room::find($attributes['room_id'])
                ->capacity;
            },
        'date'=> fake()->date(),
        'start_datetime'=> fake()->time(),
        'duration_minutes' =>fake()->randomElement([60,90,120]),
        ];
    }
}
