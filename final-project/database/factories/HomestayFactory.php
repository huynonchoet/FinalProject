<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HomestayFactory extends Factory
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
            'images' => "[" . '"' . $this->faker->image('storage/app/public/homestays', 720, 480, null, false) . '"' . "," . '"' . $this->faker->image('storage/app/public/homestays', 720, 480, null, false) . '"' . "]",
            'price' => (rand(80,900)*1000),
            'description' => Str::random(500),
            'discount' => rand(0,50),
            'quantity_room' => rand(1,10),
            'status' => $this->faker->randomElement(['0', '1']),
            'user_id' => rand(1,50),
            'kind_homestay_id' => rand(1,6)
        ];
    }
}
