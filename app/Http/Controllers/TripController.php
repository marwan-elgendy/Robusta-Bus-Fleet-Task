<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TripRepository;
use App\Http\Requests\TripCreateRequest;
use App\Http\Requests\TripSearchRequest;

class TripController extends Controller
{
    /**
     * @var TripRepository
     */
    private $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    /**
     * @param int $page
     * show all trips or paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $trips = $this->tripRepository->all();
            return response()->json([
                'success' => true,
                'data' => $trips
            ]);
        }
        $trips = $this->tripRepository->paginate($page, 3);
        return response()->json([
            'success' => true,
            'data' => $trips
        ]);
    }

    /**
     * @param TripCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TripCreateRequest $request)
    {
        $trip = $this->tripRepository->create($request->all());
        if(!$trip){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trip could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Trip successfully created',
            'data' => $trip
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trip = $this->tripRepository->find($id);
        if(!$trip){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trip not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $trip
        ], 200);
    }

    /**
     * @param string $title
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByTitle(Request $request)
    {
        $title = $request->title;
        $trip = $this->tripRepository->findbyTitle($title);
        if(!$trip){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trip not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $trip
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(TripSearchRequest $request)
    {
        $trips = $this->tripRepository->search($request->all());
        if(!$trips){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trips not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $trips
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $trip = $this->tripRepository->update($request->all(), $id);
        if(!$trip){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trip could not be updated'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Trip successfully updated',
            'data' => $trip
        ], 200);
    }

    public function destroy($id)
    {
        $trip = $this->tripRepository->delete($id);
        if(!$trip){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, trip could not be deleted'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Trip successfully deleted',
            'data' => $trip
        ], 200);
    }

}
