<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function(){
    // Group prefix auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
        Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
        Route::get('user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile'])->name('user-profile');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::put('users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/cities', [CityController::class, 'index'])->name('cities');
        Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
        Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
        Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{id}', [CityController::class, 'delete'])->name('cities.delete');

        // Trips routes
        Route::get('/trips', [TripController::class, 'index'])->name('trips');
        Route::get('/trips/{id}', [TripController::class, 'show'])->name('trips.show');
        Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
        Route::put('/trips/{id}', [TripController::class, 'update'])->name('trips.update');
        Route::delete('/trips/{id}', [TripController::class, 'delete'])->name('trips.delete');

        // Buses routes
        Route::get('/buses', [BusController::class, 'index'])->name('buses');
        Route::get('/buses/{id}', [BusController::class, 'show'])->name('buses.show');
        Route::post('/buses', [BusController::class, 'store'])->name('buses.store');
        Route::put('/buses/{id}', [BusController::class, 'update'])->name('buses.update');
        Route::delete('/buses/{id}', [BusController::class, 'delete'])->name('buses.delete');

        // Seats routes
        Route::get('/seats', [SeatController::class, 'index'])->name('seats');
        Route::get('/seats/{id}', [SeatController::class, 'show'])->name('seats.show');
        Route::post('/seats', [SeatController::class, 'store'])->name('seats.store');
        Route::put('/seats/{id}', [SeatController::class, 'update'])->name('seats.update');
        Route::delete('/seats/{id}', [SeatController::class, 'delete'])->name('seats.delete');

        // Bookings routes
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('/bookings/{id}', [BookingController::class, 'delete'])->name('bookings.delete');
        
        // TripStops routes
        Route::get('/trip-stops', [TripStopController::class, 'index'])->name('trip-stops');
        Route::get('/trip-stops/{id}', [TripStopController::class, 'show'])->name('trip-stops.show');
        Route::post('/trip-stops', [TripStopController::class, 'store'])->name('trip-stops.store');
        Route::put('/trip-stops/{id}', [TripStopController::class, 'update'])->name('trip-stops.update');
        Route::delete('/trip-stops/{id}', [TripStopController::class, 'delete'])->name('trip-stops.delete');
        
    });
});

