<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'trip_id',
        'seat_id',
        'start_stop_id',
        'end_stop_id',
        'ticket_number',
        'cost',
        'created_at',
        'updated_at'
    ];


    /**
     * Get the user that owns the Booking
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the seat that is booked
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * Get the trip that is booked
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Get the bus for the Booking
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function bus()
    {
        return $this->hasOneThrough(Bus::class, Seat::class);
    }

    /**
     * Get the start stop for the Booking
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startStop()
    {
        return $this->belongsTo(TripStop::class, 'start_stop_id');
    }

    /**
     * Get the end stop for the Booking
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endStop()
    {
        return $this->belongsTo(TripStop::class, 'end_stop_id');
    }
}
