<?php

namespace App\Repositories;

use App\Http\Resources\BusResource;
use App\Models\Bus;
use App\Models\BusSeat;
use Illuminate\Support\Facades\DB;

/**
 * Class BusRepository.
 */
class BusRepository
{
    /**
     * @param array $data
     * @return Bus
     */
    public function create(array $data)
    {
        # Create a Transaction to save bus and create seats using BusSeat model based on number of seats
        $bus = null;
        DB::transaction(function() use ($data, &$bus){
            $bus = Bus::create([
                'bus_code'=>$data['bus_code']
            ]);

            # Create seats
            for($i = 1; $i <= $data['total_seats']; $i++){
                BusSeat::create([
                    'bus_id'=>$bus->id,
                    'seat_number'=>$i,
                ]);
            }
        }, 3);

        return $bus;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function find($id)
    {
        $bus = Bus::find($id);
        if($bus){
            return BusResource::make($bus);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function findbyCode($code)
    {
        $bus = Bus::where('bus_code', $code)->first();
        if($bus){
            return BusResource::make($bus);
        }
        return null;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function update(array $data, $id)
    {
        $bus = Bus::findOrFail($id);
        $bus->update($data);
        return BusResource::make($bus);
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function delete($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        return $bus;
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function all(){
        return BusResource::collection(Bus::all());
    }

    /**
     * @param array $data
     * @return Bus
     */
    public function paginate($page, $perPage){
        $buses = Bus::paginate($perPage, ['*'], 'page', $page);
        return BusResource::collection($buses)->response()->getData(true);
    }
}