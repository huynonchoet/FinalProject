<?php

namespace Database\Seeders;

use App\Models\KindHomestay;
use Illuminate\Database\Seeder;

class KindHomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KindHomestay::insert([
            'name' => 'Single bed room',
        ]);
        KindHomestay::insert([
            'name' => 'Twin bed room',
        ]);
        KindHomestay::insert([
            'name' => 'Double bed room',
        ]);
        KindHomestay::insert([
            'name' => 'Family room',
        ]);
        KindHomestay::insert([
            'name' => 'Studio room',
        ]);
        KindHomestay::insert([
            'name' => 'Full House',
        ]);
    }
}
