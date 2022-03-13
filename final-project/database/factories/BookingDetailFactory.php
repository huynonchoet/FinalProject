<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id'=>rand(1,50),
            'room_id'=>rand(1,30),
            'price' => (rand(80,800)*1000),
            'quantity_room' => rand(1,10),
        ];
    }
}
