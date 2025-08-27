<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVeterinarianRequest extends FormRequest
{
    public function authorize()
    {
        // Users must be authorized to update this veterinarian
        return auth()->check();
    }

    public function rules()
    {
        // $this->route('veterinarian') resolves the Owner model injected by route-model binding
        $veterinarianId = $this->route('veterinarians')->id;

        return [
            'name'       => 'required|string|max:255',
            'email'      => "required|email|unique:veterinarians,email,{$veterinarianId}",
            'phone'      => 'nullable|string|max:20',
            'specialization'    => 'required|string|max:255',
        ];
    }
}