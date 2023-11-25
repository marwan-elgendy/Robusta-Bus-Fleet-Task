<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TripStop;
use Illuminate\Support\Carbon;

class BusTripStopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TripStop::Insert([
            [
                'trip_id' => 1,
                'city_id' => 1,
                'order' => 1,
                'date' => date('Y-m-d'),
                'departure_time' => '10:00:00',
                'arrival_time' => '12:00:00',
                'cost' => 0
            ],
            [  
                'trip_id' => 1,
                'city_id' => 2,
                'order' => 2,
                'date' => date('Y-m-d'),
                'departure_time' => '12:00:00',
                'arrival_time' => '14:00:00',
                'cost' => 50
            ],
            [  
                'trip_id' => 1,
                'city_id' => 3,
                'order' => 3,
                'date' => date('Y-m-d'),
                'departure_time' => '14:00:00',
                'arrival_time' => '16:00:00',
                'cost' => 50
            ],
            [  
                'trip_id' => 1,
                'city_id' => 4,
                'order' => 4,
                'date' => date('Y-m-d'),
                'departure_time' => '16:00:00',
                'arrival_time' => '18:00:00',
                'cost' => 50
            ],
            [  
                'trip_id' => 1,
                'city_id' => 5,
                'order' => 5,
                'date' => date('Y-m-d'),
                'departure_time' => '18:00:00',
                'arrival_time' => '20:00:00',
                'cost' => 50
            ],
            [  
                'trip_id' => 1,
                'city_id' => 6,
                'order' => 6,
                'date' => date('Y-m-d'),
                'departure_time' => '20:00:00',
                'arrival_time' => '22:00:00',
                'cost' => 50
            ],
            # Trip from Cairo to Aswan
            [
                'trip_id' => 2,
                'city_id' => 1,
                'order' => 1,
                'date' => date('Y-m-d'),
                'departure_time' => '10:00:00',
                'arrival_time' => '12:00:00',
                'cost' => 0
            ],
            [
                'trip_id' => 2,
                'city_id' => 2,
                'order' => 2,
                'date' => date('Y-m-d'),
                'departure_time' => '12:00:00',
                'arrival_time' => '14:00:00',
                'cost' => 50
            ],
            [
                'trip_id' => 2,
                'city_id' => 3,
                'order' => 3,
                'date' => date('Y-m-d'),
                'departure_time' => '14:00:00',
                'arrival_time' => '16:00:00',
                'cost' => 50
            ],
            [
                'trip_id' => 2,
                'city_id' => 4,
                'order' => 4,
                'date' => date('Y-m-d'),
                'departure_time' => '16:00:00',
                'arrival_time' => '18:00:00',
                'cost' => 50
            ],
            [
                'trip_id' => 2,
                'city_id' => 5,
                'order' => 5,
                'date' => date('Y-m-d'),
                'departure_time' => '18:00:00',
                'arrival_time' => '20:00:00',
                'cost' => 50
            ],
            [
                'trip_id' => 2,
                'city_id' => 6,
                'order' => 6,
                'date' => date('Y-m-d'),
                'departure_time' => '20:00:00',
                'arrival_time' => '22:00:00',
                'cost' => 50
            ],
            [
                'trip_id' => 2,
                'city_id' => 7,
                'order' => 7,
                'date' => date('Y-m-d'),
                'departure_time' => '22:00:00',
                'arrival_time' => '24:00:00',
                'cost' => 50
            ],
            # Trip from Cairo straight to Aswan
            [
                'trip_id' => 3,
                'city_id' => 1,
                'order' => 1,
                'date' => date('Y-m-d'),
                'departure_time' => '10:00:00',
                'arrival_time' => '12:00:00',
                'cost' => 0
            ],
            [
                'trip_id' => 3,
                'city_id' => 7,
                'order' => 2,
                'date' => date('Y-m-d'),
                'departure_time' => '12:00:00',
                'arrival_time' => '14:00:00',
                'cost' => 400
            ],
            # Trip from AlFayyum to Cairo
            [
                'trip_id' => 4,
                'city_id' => 3,
                'order' => 1,
                'date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'departure_time' => '15:00:00',
                'arrival_time' => '17:00:00',
                'cost' => 0
            ],
            [
                'trip_id' => 4,
                'city_id' => 1,
                'order' => 2,
                'date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'departure_time' => '17:00:00',
                'arrival_time' => '19:00:00',
                'cost' => 200
            ]
        ]);
                
    }
}
