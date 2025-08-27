<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        // Only authenticated users can create owners
        return auth()->check();
    }

    public function rules()
    {
        return [
            'pet_id'     => 'required|bigint|unique:pets,name',
            'vet_id'     => 'required|bigint|unique:veterinarians, name',
            'scheduled_at'      => 'required|datetime',
            'status'      => 'nullable|string|max:20',
            'notes'      => 'required|string|max:255',
        ];
    }
}