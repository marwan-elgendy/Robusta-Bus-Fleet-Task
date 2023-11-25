<?php

namespace App\Repositories;

use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\TripStop;
use Illuminate\Support\Facades\DB;

/**
 * Class BusRepository.
 */
class TripRepository
{    
    /**
    * @param array $data
    * @return Trip
    */
    public function create(array $data)
    {
        $trip = null;
        # Create a Transaction to save bus and create seats using BusSeat model based on number of seats
        DB::transaction(function() use (&$trip, $data){
            $trip = Trip::create([
                'title'=>$data['title'],
                'bus_id'=>$data['bus_id'],
                'start_city_id'=>$data['start_city_id'],
                'end_city_id'=>$data['end_city_id'],
            ]);
    
            # Create stops
            foreach($data['trip_stops'] as $stop){
                TripStop::create([
                    'trip_id'=>$trip->id,
                    'city_id'=>$stop['city_id'],
                    'order'=>$stop['order'],
                    'date'=>$stop['date'],
                    'arrival_time'=>$stop['arrival_time'],
                    'departure_time'=>$stop['departure_time'],
                    'cost'=>$stop['cost'],
                ]);
            }

            return $trip;
        }, 5);

        return TripResource::make($trip);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function find($id)
    {
        $trip = Trip::find($id);
        if($trip){
            return TripResource::make($trip);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function findbyTitle($title)
    {
        $trips = Trip::where('title', 'like', '%'.$title.'%')->get();
        return TripResource::collection($trips)->response()->getData(true);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function update(array $data, $id){
        $trip = Trip::findOrFail($id);
        $trip->update($data);
        return TripResource::make($trip);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function delete($id){
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return $trip;
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function addStop($trip_id, $stop){
        $trip = Trip::findOrFail($trip_id);
        $lastStop = $trip->stops()->orderBy('order', 'desc')->first();
        # Add stop with order more than the last stop by 1
        $stop['order'] = $lastStop->order + 1;
        $trip->stops()->create($stop);

        return TripResource::make($trip);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function updateStop($trip_id, $stop_id, $stop){
        $trip = Trip::findOrFail($trip_id);
        $trip->stops()->findOrFail($stop_id)->update($stop);
        return TripResource::make($trip);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function deleteStop($trip_id, $stop_id){
        $trip = Trip::findOrFail($trip_id);
        $trip->stops()->findOrFail($stop_id)->delete();
        return TripResource::make($trip);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function search(array $data){
        $start_city_id = $data['start_city_id'];
        $end_city_id = $data['end_city_id'];
        $date = $data['date'];
        # Get all trips that have a stop in the start city
        $trips = Trip::whereHas('tripStops', function($query) use ($start_city_id){
            $query->where('city_id', $start_city_id);
        })
        ->whereHas('tripStops', function($query) use ($date){
            $query->where('date', $date);
        })
        # Get all trips that have a stop in the end city
        ->whereHas('tripStops', function($query) use ($end_city_id){
            $query->where('city_id', $end_city_id);
        })
        # Get all trips that have a stop in the start city before the stop in the end city
        ->whereHas('tripStops', function($query) use ($start_city_id, $end_city_id){
            $query->where('city_id', $start_city_id)->where('order', '<', function($query) use ($end_city_id){
                $query->selectRaw('MAX(`order`)')->from('trip_stops')->where('city_id', $end_city_id);
            });
        })
        ->get();

        return TripResource::collection($trips)->response()->getData(true);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function all(){
        $trips = Trip::all();
        return TripResource::collection($trips)->response()->getData(true);
    }

    /**
     * @param array $data
     * @return Trip
     */
    public function paginate($page, $perPage){
        $trips = Trip::paginate($perPage, ['*'], 'page', $page);
        return TripResource::collection($trips)->response()->getData(true);
    }
}