<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
{
    public function authorize()
    {
        // Only authenticated users can create owners
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:owners,email',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'required|string|max:255',
        ];
    }
}