<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust this if you need to check permissions:
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Grab the ID of the user being updated from route-model binding
        $userId = $this->route('user')->id;

        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password'              => ['nullable', 'string', 'min:8', 'confirmed'],
            'role'                  => ['required', 'in:admin,owner,veterinarian'],

            // Owner‐only fields
            'owner_phone'           => ['required_if:role,owner', 'string', 'max:20'],
            'owner_address'         => ['required_if:role,owner', 'string', 'max:255'],

            // Veterinarian‐only fields
            'vet_name'              => ['required_if:role,veterinarian', 'string', 'max:255'],
            'vet_phone'             => ['required_if:role,veterinarian', 'string', 'max:20'],
            'license_number'        => [
                'required_if:role,veterinarian',
                'string',
                Rule::unique('veterinarians', 'license_number')
                    ->ignore($this->route('user')->veterinarian?->id ?? null),
            ],
            'specialization'        => ['required_if:role,veterinarian', 'string', 'max:255'],
        ];
    }
}