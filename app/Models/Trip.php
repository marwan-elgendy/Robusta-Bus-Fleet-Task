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
}
