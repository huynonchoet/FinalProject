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
            'status' => '1'
        ]);
        TypeRoom::insert([
            'name' => 'Twin bed room',
            'status' => '1'
        ]);
        TypeRoom::insert([
            'name' => 'Double bed room',
            'status' => '1'
        ]);
        TypeRoom::insert([
            'name' => 'Family room',
            'status' => '1'
        ]);
        TypeRoom::insert([
            'name' => 'Studio room',
            'status' => '1'
        ]);
        TypeRoom::insert([
            'name' => 'Full House',
            'status' => '1'
        ]);
    }
}
