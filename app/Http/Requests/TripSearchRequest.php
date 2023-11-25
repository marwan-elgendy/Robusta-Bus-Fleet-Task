<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        # Check if the user is logged in
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
            'start_city_id' => 'required|integer|exists:cities,id',
            'end_city_id' => 'required|integer|exists:cities,id',
            'date' => 'required|date_format:Y-m-d',
        ];
    }
}
