<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Http\Requests\BookingCreateRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Requests\GetAvailableSeatsRequest;

class BookingController extends Controller
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param int $page
     * show all bookings or paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $bookings = $this->bookingRepository->all();
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);
        }
        $bookings = $this->bookingRepository->paginate($page, 3);
        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    public function myBookings()
    {
        $user = auth()->user();
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $bookings = $this->bookingRepository->userBookings($user->id);
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);
        }
        $bookings = $this->bookingRepository->userBookingsPaginate($user->id, $page, 3);
        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    /**
     * @param BookingCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookingCreateRequest $request)
    {  
        $user = auth()->user();
        $booking = $this->bookingRepository->create($request->all(), $user->id);
        if(!$booking){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, booking could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Booking successfully created',
            'data' => $booking
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $booking = $this->bookingRepository->find($id);
        if(!$booking){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, booking not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByCode($code)
    {
        $booking = $this->bookingRepository->findByCode($code);
        if(!$booking){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, booking not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

    public function getAvailableSeats(GetAvailableSeatsRequest $request)
    {
        $trip_id = $request->trip_id;
        $start_stop_id = $request->start_stop_id;
        $end_stop_id = $request->end_stop_id;
        $seats = $this->bookingRepository->getAvailableSeats($trip_id, $start_stop_id, $end_stop_id);
        return response()->json([
            'success' => true,
            'data' => $seats
        ], 200);
    }

}