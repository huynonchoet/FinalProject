<?php

namespace Database\Seeders;

use App\Models\BookingDetail;
use Illuminate\Database\Seeder;

class BookingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookingDetail::factory()
            ->count(100)
            ->create();
    }
}
