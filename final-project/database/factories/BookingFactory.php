<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(11, 50),
            'day_start' => $this->faker->dateTimeBetween('now', '+49 days'),
            'day_end' => $this->faker->dateTimeBetween('+50 days', '+100 days'),
            'status' => $this->faker->randomElement(['0', '1', '2']),
        ];
    }
}
