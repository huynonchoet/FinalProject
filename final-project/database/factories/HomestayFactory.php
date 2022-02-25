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
            'address' => $this->faker->address(),
            'phone' => $this->faker->numerify('##########'),
            'user_id' => rand(1,50),
        ];
    }
}
