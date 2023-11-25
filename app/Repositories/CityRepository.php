<?php

namespace App\Repositories;

use App\Http\Resources\CityResource;
use App\Models\City;

/**
 * Class BusRepository.
 */
class CityRepository
{

    /**
     * @param array $data
     * @return City
     */
    public function create(array $data)
    {
        $city = City::create([
            'name'=>$data['name'],
        ]);
        return CityResource::make($city);
    }

    /**
     * @param array $data
     * @return City
     */
    public function find($id)
    {
        $city = City::find($id);
        if($city){
            return CityResource::make($city);
        }
        return null;
    }

    /**
     * @param array $data
     * @return City
     */
    public function findbyName($name)
    {
        $city = City::where('name', $name)->first();
        return CityResource::make($city);
    }

    /**
     * @param array $data
     * @return City
     */
    public function update(array $data, $id)
    {
        $city = City::findOrFail($id);
        $city->update($data);
        return CityResource::make($city);
    }

    /**
     * @param array $data
     * @return City
     */
    public function delete($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return $city;
    }

    /**
     * @param array $data
     * @return City
     */
    public function all(){
        return CityResource::collection(City::all());
    }

    /**
     * @param array $data
     * @return City
     */
    public function paginate($page, $perPage){
        $cities = City::paginate($perPage, ['*'], 'page', $page);
        return CityResource::collection($cities)->response()->getData(true);
    }
    
}