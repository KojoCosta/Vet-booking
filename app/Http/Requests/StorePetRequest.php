<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize()
    {
        // Only authenticated users can create owners
        return auth()->check();
    }

    public function rules()
    {
        return [
            //'owner_id'   => 'required|bigint|max:20',
            'owner_id'   => 'required|name|unique:owners,name',
            'name'       => 'required|string|max:255',
            'species'    => 'required|string|max:255',
            'breed'      => 'nullable|string|max:255',
            'birthdate'  => 'nullable|date',
            'sex'        => 'nullable|string|max:255',
        ];
    }
}