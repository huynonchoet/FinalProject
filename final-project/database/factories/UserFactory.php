<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('123456789'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['0', '1']),
            'avatar' => $this->faker->image('storage/app/public/users', 140, 180, null, false),
            'birthday' => $this->faker->dateTime($max = '01/01/2015', $timezone = null),
            'address' => $this->faker->address(),
            'role' => '0',
            'phone' => $this->faker->phoneNumber(),
            'bank_number' => '19036103013017',
            'status' => '0',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
