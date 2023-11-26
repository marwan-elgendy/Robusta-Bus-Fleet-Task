<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Http\Resources\BookingResource;
use App\Models\Trip;
use App\Models\TripStop;
use Illuminate\Support\Str;


/**
 * Class BusRepository.
 */
class BookingRepository
{

    /**
     * @param array $data
     * @return Bus
     */
    public function create(array $data, $user_id){
        $cost = $this->GetPrice($data['trip_id'], $data['start_stop_id'], $data['end_stop_id']);
        $seat_available = $this->CheckSeatAvailability($data['trip_id'], $data['start_stop_id'], $data['end_stop_id'], $data['seat_id']);
        if(!$seat_available){
            return null;
        }
        $booking = Booking::create([
            'trip_id'=>$data['trip_id'],
            'user_id'=>$user_id,
            'seat_id'=>$data['seat_id'],
            'start_stop_id'=>$data['start_stop_id'],
            'end_stop_id'=>$data['end_stop_id'],
            'cost'=>$cost,
            'ticket_number' => Str::uuid()->toString(),
        ]);

        return BookingResource::make($booking);
    }

    public function CheckSeatAvailability($trip_id, $start_stop_id, $end_stop_id, $seat_id){
        $seats = $this->getAvailableSeats($trip_id, $start_stop_id, $end_stop_id);
        foreach($seats as $seat){
            if($seat->id == $seat_id){
                return true;
            }
        }
        return false;
    }
    

    /**
     * @param $trip_id
     * @param $start_stop_id
     * @param $end_stop_id
     * @return int
     */
    public function GetPrice($trip_id, $start_stop_id, $end_stop_id){
        # Find the pricing for the trip
        $trip = Trip::find($trip_id);
        $start_stop = TripStop::find($start_stop_id);
        $end_stop = TripStop::find($end_stop_id);
        $start_stop_order = $start_stop->order;
        $end_stop_order = $end_stop->order;
        $stops = $trip->tripStops;
        $cost = 0;
        foreach($stops as $stop){
            $stop_order = $stop->order;
            if($stop_order >= $start_stop_order && $stop_order <= $end_stop_order){
                $cost += $stop->cost;
            }
        }
        return $cost;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function find($id){
        $booking = Booking::find($id);
        if($booking){
            return BookingResource::make($booking);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Booking
     */
    public function all(){
        $bookings = Booking::all();
        if($bookings){
            return BookingResource::collection($bookings);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function getAvailableSeats($trip_id, $start_stop_id, $end_stop_id){
        $trip = Trip::find($trip_id);
        if($trip){
            $seats = $trip->bus->seats;
            $bookings = Booking::where('trip_id', $trip_id)->get();
            $booked_seats = [];
            foreach($bookings as $booking){
                array_push($booked_seats, $booking->seat_id);
            }
            $seats_available = [];
            foreach($seats as $seat){
                if(!in_array($seat->id, $booked_seats)){
                    array_push($seats_available, $seat);
                }
            }

            # Check if the booked seats are not booked between the start stop and end stop, find by the order of the stops
            
            $start_stop = TripStop::find($start_stop_id);
            $end_stop = TripStop::find($end_stop_id);
            $start_stop_order = $start_stop->order;
            $end_stop_order = $end_stop->order;
            $bookings = Booking::where('trip_id', $trip_id)->get();
            $booked_seats = [];
            foreach($bookings as $booking){
                $booking_start_stop = $booking->startStop;
                $booking_end_stop = $booking->endStop;
                $booking_start_stop_order = $booking_start_stop->order;
                $booking_end_stop_order = $booking_end_stop->order;
                if($booking_start_stop_order <= $start_stop_order && $booking_end_stop_order >= $end_stop_order){
                    array_push($booked_seats, $booking->seat_id);
                }
            }
            foreach($seats as $seat){
                if(!in_array($seat->id, $booked_seats)){
                    array_push($seats_available, $seat);
                }
            }


            return $seats_available;
        }
        return null;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function getBookings($user_id){
        $bookings = Booking::where('user_id', $user_id)->get();
        if($bookings){
            return BookingResource::collection($bookings);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function getBookingsByTrip($trip_id){
        $bookings = Booking::where('trip_id', $trip_id)->get();
        if($bookings){
            return BookingResource::collection($bookings);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Booking
     */
    public function paginate($page, $perPage){
        $bookings = Booking::paginate($perPage, ['*'], 'page', $page);
        return BookingResource::collection($bookings)->response()->getData(true);
    }

    /**
     * @param array $data
     * @return Booking
     */
    public function userBookings($user_id){
        $bookings = Booking::where('user_id', $user_id)->get();
        if($bookings){
            return BookingResource::collection($bookings);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Booking
     */
    public function userBookingsPaginate($user_id, $page, $perPage){
        $bookings = Booking::where('user_id', $user_id)->paginate($perPage, ['*'], 'page', $page);
        return BookingResource::collection($bookings)->response()->getData(true);
    }
}