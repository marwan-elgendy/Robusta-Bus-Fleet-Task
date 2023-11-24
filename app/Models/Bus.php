<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;


    protected $fillable = [
        'bus_code',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the seats for the Bus
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Get all of the bookings for the Bus
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Seat::class);
    }

    /**
     * Get all of the trips for the Bus
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
