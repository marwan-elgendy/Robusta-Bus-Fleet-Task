<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAvailableSeatsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => 'required|integer|exists:trips,id',
            'start_stop_id' => 'required|integer|exists:trip_stops,id',
            'end_stop_id' => 'required|integer|exists:trip_stops,id|different:start_stop_id'
        ];
    }
}
