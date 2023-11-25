<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CityRepository;
use App\Http\Requests\CityCreateRequest;

class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param int $page
     * show all cities or paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $cities = $this->cityRepository->all();
            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        }
        $cities = $this->cityRepository->paginate($page, 3);
        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    /**
     * @param CityCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CityCreateRequest $request)
    {
        $city = $this->cityRepository->create($request->all());
        if(!$city){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'City successfully created',
            'data' => $city
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);
        if(!$city){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $city
        ], 200);
    }

    /**
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByName($name)
    {
        $city = $this->cityRepository->findByName($name);
        if(!$city){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $city
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $city = $this->cityRepository->update($request->all(), $id);
        if(!$city){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city could not be updated'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'City successfully updated',
            'data' => $city
        ], 200);
    }

    public function destroy($id)
    {
        $city = $this->cityRepository->delete($id);
        if(!$city){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city could not be deleted'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'City successfully deleted',
            'data' => $city
        ], 200);
    }

}