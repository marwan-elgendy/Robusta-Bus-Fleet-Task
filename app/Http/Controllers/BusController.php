<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BusRepository;
use App\Http\Requests\BusCreateRequest;
use App\Http\Requests\BusUpdateRequest;

class BusController extends Controller
{
    /**
     * @var BusRepository
     */
    private $busRepository;

    public function __construct(BusRepository $busRepository)
    {
        $this->busRepository = $busRepository;
    }

    /**
     * @param int $page
     * show all buses or paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $buses = $this->busRepository->all();
            return response()->json([
                'success' => true,
                'data' => $buses
            ]);
        }
        $buses = $this->busRepository->paginate($page, 3);
        return response()->json([
            'success' => true,
            'data' => $buses
        ]);
    }

    /**
     * @param BusCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BusCreateRequest $request)
    {  
        $bus = $this->busRepository->create($request->all());
        if(!$bus){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, bus could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bus successfully created',
            'data' => $bus
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $bus = $this->busRepository->find($id);
        if(!$bus){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, bus not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $bus
        ], 200);
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByCode($code)
    {
        $bus = $this->busRepository->findByCode($code);
        if(!$bus){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, bus not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $bus
        ], 200);
    }

    public function update(BusUpdateRequest $request, $id)
    {
        $bus = $this->busRepository->update($request->all(), $id);
        if(!$bus){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, bus could not be updated'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bus successfully updated',
            'data' => $bus
        ], 200);
    }

    public function destroy($id)
    {
        $bus = $this->busRepository->delete($id);
        if(!$bus){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, bus could not be deleted'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bus successfully deleted',
            'data' => $bus
        ], 200);
    }

}
