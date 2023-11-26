<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'bus_id',
        'start_city_id',
        'end_city_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the bus used for the Trip
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    /**
     * Get the start city for the Trip
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startCity()
    {
        return $this->belongsTo(City::class, 'start_city_id');
    }

    /**
     * Get the end city for the Trip
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endCity()
    {
        return $this->belongsTo(City::class, 'end_city_id');
    }

    /**
     * Get all of the trip stops for the Trip
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripStops()
    {
        return $this->hasMany(TripStop::class);
    }

    /**
     * Get all of the bookings for the Trip
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get seats available for the Trip on a given date and start stop and end stop
     * 
     * @param string $date
     * @param int $startStopId
     * @param int $endStopId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableSeats($startStopId, $endStopId)
    {
        # Get all bookings for the trip on the given date that start at or before the start stop and end at or after the end stop
        $bookedSeats = Booking::where('trip_id', $this->id)
            ->where(function ($query) use ($startStopId, $endStopId) {
                $query->where(function ($query) use ($startStopId) {
                    $query->where('start_stop_id', '<=', $startStopId);
                })->orWhere(function ($query) use ($endStopId) {
                    $query->where('end_stop_id', '>=', $endStopId);
                });
            })->pluck('seat_id');

        return BusSeat::where('bus_id', $this->bus_id)
            ->whereNotIn('id', $bookedSeats)
            ->get();
    }
}
