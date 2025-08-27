<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
{
    public function authorize()
    {
        // Users must be authorized to update this owner
        return auth()->check();
    }

    public function rules()
    {
        // $this->route('owner') resolves the Owner model injected by route-model binding
        $ownerId = $this->route('owners')->id;

        return [
            'name'       => 'required|string|max:255',
            'email'      => "required|email|unique:owners,email,{$ownerId}",
            'phone'      => 'nullable|string|max:20',
            'address'    => 'required|string|max:255',
        ];
    }
}