<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripStop extends Model
{
    use HasFactory;


    protected $fillable = [
        'trip_id',
        'city_id',
        'order',
        'date',
        'departure_time',
        'arrival_time',
        'cost',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the trip that owns the TripStop
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    /**
     * Get the city that owns the TripStop
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
