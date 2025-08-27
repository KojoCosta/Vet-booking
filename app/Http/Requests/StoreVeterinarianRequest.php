<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVeterinarianRequest extends FormRequest
{
    public function authorize()
    {
        // Only authenticated users can create veterinarians
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:veterinarians,email',
            'phone'      => 'nullable|string|max:20',
            'specialization'    => 'required|string|max:255',
        ];
    }
}