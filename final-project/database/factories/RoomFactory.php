<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'images'=>"[" . '"' . $this->faker->image('storage/app/public/rooms', 720, 480, null, false) . '"' . "," . '"' . $this->faker->image('storage/app/public/rooms', 720, 480, null, false) . '"' . "]",
            'price' => (rand(80,800)*1000),
            'description' => $this->faker->text(),
            'discount' => 0,
            'quantity_room' => rand(5, 10),
            'status' => '0',
            'homestay_id' => rand(1,10),
            'type_room_id' => rand(1,6),
        ];
    }
}
