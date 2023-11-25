<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusSeat;

class BusSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($bus = 1; $bus <= 10; $bus++) {
            for ($seat = 1; $seat <= 12; $seat++) {
                BusSeat::Insert([
                    [
                        'bus_id' => $bus,
                        'seat_number' => $seat
                    ]
                ]);
            }
        }
    }
}
