<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust this if you need to check permissions:
        //return true;
        // only admins can add users
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'role'                  => ['required', 'in:admin,owner,veterinarian'],

            // Owner‐only fields
            'owner_phone'           => ['required_if:role,owner', 'string', 'max:20'],
            'owner_address'         => ['required_if:role,owner', 'string', 'max:255'],

            // Veterinarian‐only fields
            'vet_name'              => ['required_if:role,veterinarian', 'string', 'max:255'],
            'vet_phone'             => ['required_if:role,veterinarian', 'string', 'max:20'],
            'license_number'        => ['required_if:role,veterinarian', 'string', 'unique:veterinarians,license_number'],
            'specialization'        => ['required_if:role,veterinarian', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'owner_phone.required_if'      => 'Owner’s phone is required when role is Owner.',
            'vet_name.required_if'         => 'Clinic display name is required for Veterinarian.',
            // …you can add more custom messages here…
        ];
    }

}