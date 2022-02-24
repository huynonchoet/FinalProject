<?php

namespace Database\Seeders;

use App\Models\Homestay;
use Illuminate\Database\Seeder;

class HomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Homestay::factory()
            ->count(200)
            ->create();
    }
}
