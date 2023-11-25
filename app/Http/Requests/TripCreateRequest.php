<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'bus_id' => 'required|integer|exists:buses,id',
            'start_city_id' => 'required|integer|exists:cities,id',
            'end_city_id' => 'required|integer|exists:cities,id',
            'trip_stops' => 'required|array',
            'trip_stops.*.city_id' => 'required|integer|exists:cities,id',
            'trip_stops.*.arrival_time' => 'required|date_format:H:i',
            'trip_stops.*.departure_time' => 'required|date_format:H:i',
            'trip_stops.*.order' => 'required|integer|min:1',
            # First trip stop should be the start city
            'trip_stops.0.city_id' => 'required|integer|exists:cities,id|in:'.$this->start_city_id,
            # Last trip stop should be the end city
            'trip_stops.'.count($this->trip_stops).'.city_id' => 'required|integer|exists:cities,id|in:'.$this->end_city_id,
            # First trip stop should have departure time greater than current time
            'trip_stops.0.departure_time' => 'required|date_format:H:i|after:now',
            # Trip stop arrival time should be greater than departure time
            'trip_stops.*.arrival_time' => 'required|date_format:H:i|after:trip_stops.*.departure_time',
            # Trip stop departure time should be greater than previous stop arrival time
            'trip_stops.*.departure_time' => 'required|date_format:H:i|after:trip_stops.*.arrival_time',
            # Trip stop cost should be greater than or equal to 0
            'trip_stops.0.cost' => 'required|integer|min:0|max:0',
            # Trip stop order should be unique for each trip
            'trip_stops.*.order' => 'required|integer|unique:trip_stops,order,NULL,id,trip_id,'.$this->id,
        ];
    }
}
