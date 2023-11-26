<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trip_id' => $this->trip_id,
            'user_id' => $this->user_id,
            'seat_id' => $this->seat_id,
            'start_stop' => $this->startStop,
            'end_stop' => $this->endStop,
            'cost' => $this->cost,
            'ticket_number' => $this->ticket_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
