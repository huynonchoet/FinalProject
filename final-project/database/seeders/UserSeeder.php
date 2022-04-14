<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'name' => 'admin',
            'gender' => '0',
            'avatar' => null,
            'birthday' => '2022/05/10',
            'address' => 'Việt Nam',
            'role' => '2',
            'phone' => '0123456798',
            'bank_number' => '19036103013017',
            'status' => '0',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::factory()
            ->count(49)
            ->create();
    }
}
