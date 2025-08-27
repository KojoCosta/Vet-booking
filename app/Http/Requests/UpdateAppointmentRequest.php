<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        // Users must be authorized to update this owner
        return auth()->check();
    }

    public function rules()
    {
        // $this->route('owner') resolves the Owner model injected by route-model binding
        $appointmentId = $this->route('appointments')->id;

        return [
            
            'pet_id'     => 'required|bigint|unique:pets,name',
            'vet_id'     => "required|bigint|unique:veterinarians, name,{$appointmentId}",
            'scheduled_at'      => 'required|datetime',
            'status'      => 'nullable|string|max:20',
            'notes'      => 'required|string|max:255',
        ];
    }
}