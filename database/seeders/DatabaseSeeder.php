<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BusSeeder::class);
        $this->call(BusSeatSeeder::class);
        $this->call(TripSeeder::class);
        $this->call(BusTripStopSeeder::class);
        $this->call(BookingSeeder::class);
    }
}
