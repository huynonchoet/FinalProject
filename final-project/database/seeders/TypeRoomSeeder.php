<?php

namespace Database\Seeders;

use App\Models\TypeRoom;
use Illuminate\Database\Seeder;

class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeRoom::insert([
            'name' => 'Single bed room',
        ]);
        TypeRoom::insert([
            'name' => 'Twin bed room',
        ]);
        TypeRoom::insert([
            'name' => 'Double bed room',
        ]);
        TypeRoom::insert([
            'name' => 'Family room',
        ]);
        TypeRoom::insert([
            'name' => 'Studio room',
        ]);
        TypeRoom::insert([
            'name' => 'Full House',
        ]);
    }
}
