<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeRoomSeeder::class,
            UserSeeder::class,
            // HomestaySeeder::class,
            // RoomSeeder::class,
            // BookingSeeder::class,
            // BookingDetailSeeder::class,
        ]);
    }
}
