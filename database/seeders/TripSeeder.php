<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trip::Insert([
            [
                'title' => 'Cairo to Luxor',
                'bus_id' => 1,
                'start_city_id' => 1,
                'end_city_id' => 6
            ],
            [
                'title' => 'Cairo to Aswan',
                'bus_id' => 2,
                'start_city_id' => 1,
                'end_city_id' => 7
            ],
            [
                'title' => 'Cairo Straight to Aswan',
                'bus_id' => 3,
                'start_city_id' => 1,
                'end_city_id' => 7
            ],
            [
                'title' => 'AlFayyum to Cairo',
                'bus_id' => 4,
                'start_city_id' => 3,
                'end_city_id' => 1
            ]
        ]);
    }
}
