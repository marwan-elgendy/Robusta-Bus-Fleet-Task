<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::group(['prefix' => 'auth'], function () {
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth:api')->group(function(){
    // Group prefix auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::get('user-profile', [AuthController::class, 'userProfile'])->name('user-profile');
    });

    // Trip routes
    Route::get('/trips', [TripController::class, 'index'])->name('trips');
    Route::get('/trips/{id}', [TripController::class, 'show'])->name('trips.show');
    Route::post('/trips/title', [TripController::class, 'showByTitle'])->name('trips.showByTitle');
    Route::post('/trips/search', [TripController::class, 'search'])->name('trips.search');

    // Bookings routes
    Route::get('/bookings/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.myBookings');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/getavailableseats', [BookingController::class, 'getAvailableSeats'])->name('bookings.getAvailableSeats');
    
    // Group prefix admin
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::post('users/name', [UserController::class, 'showByName'])->name('users.showByName');
        Route::post('users/email', [UserController::class, 'showByEmail'])->name('users.showByEmail');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/cities', [CityController::class, 'index'])->name('cities');
        Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
        Route::get('/cities/name/{name}', [CityController::class, 'showByName'])->name('cities.showByName');
        Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
        Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.delete');

        // Trips routes
        Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
        Route::put('/trips/{id}', [TripController::class, 'update'])->name('trips.update');
        Route::delete('/trips/{id}', [TripController::class, 'destroy'])->name('trips.delete');

        // Buses routes
        Route::get('/buses', [BusController::class, 'index'])->name('buses');
        Route::get('/buses/{id}', [BusController::class, 'show'])->name('buses.show');
        Route::get('/buses/code/{code}', [BusController::class, 'showByCode'])->name('buses.showByCode');
        Route::post('/buses', [BusController::class, 'store'])->name('buses.store');
        Route::put('/buses/{id}', [BusController::class, 'update'])->name('buses.update');
        Route::delete('/buses/{id}', [BusController::class, 'destroy'])->name('buses.delete');

        // Bookings routes
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    });
});

