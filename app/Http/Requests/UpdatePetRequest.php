<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{
    public function authorize()
    {
        // Users must be authorized to update this owner
        return auth()->check();
    }

    public function rules()
    {
        // $this->route('owner') resolves the Owner model injected by route-model binding
        $petId = $this->route('pets')->id;

        return [
            'owner_id'   => 'required|name|unique:owners,name',{$petId},
            'name'       => 'required|string|max:255',
            'species'    => 'required|string|max:255',
            'breed'      => 'nullable|string|max:255',
            'birthdate'  => 'nullable|date',
            'sex'        => 'nullable|string|max:255',
        ];
    }
}