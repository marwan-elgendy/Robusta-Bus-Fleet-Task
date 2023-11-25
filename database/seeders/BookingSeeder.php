<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use Ramsey\Uuid\Uuid;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::Insert([
            [
                'user_id' => 1,
                'trip_id' => 1,
                'seat_id' => 1,
                'start_stop_id' => 1,
                'end_stop_id' => 3,
                'cost' => 100,
                'ticket_number' => Uuid::uuid4()->toString(),
            ],
            [
                'user_id' => 2,
                'trip_id' => 3,
                'seat_id' => 10,
                'start_stop_id' => 1,
                'end_stop_id' => 7,
                'cost' => 400,
                'ticket_number' => Uuid::uuid4()->toString(),
            ]
        ]);
    }
}
