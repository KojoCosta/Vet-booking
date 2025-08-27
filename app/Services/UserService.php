<?php
// app/Services/UserService.php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->createUserRecord($data);

            if ($user->role === 'owner') {
                $this->attachOwnerData($user->id, $data);
            }

            if ($user->role === 'veterinarian') {
                $this->attachVeterinarianData($user->id, $data);
            }

            return $user;
        });
    }

    protected function createUserRecord(array $data): User
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);
    }

    protected function attachOwnerData(int $userId, array $data): void
    {
        $this->ownerModel()->create([
            'user_id' => $userId,
            'name'    => $data['owner_name'],
            'email'   => $data['owner_email'],
            'phone'   => $data['owner_phone'],
            'address' => $data['owner_address'],
        ]);
    }

    protected function attachVeterinarianData(int $userId, array $data): void
    {
        $this->veterinarianModel()->create([
            'user_id'         => $userId,
            'vet_name'        => $data['vet_name'],
            'email'           => $data['vet_email'],
            'phone'           => $data['vet_phone'],
            'license_number'  => $data['license_number'],
            'specialization'  => $data['specialization'],
        ]);
    }

    // Helpers for easy swapping or mocking
    protected function ownerModel()
    {
        return new \App\Models\Owner;
    }

    protected function veterinarianModel()
    {
        return new \App\Models\Veterinarian;
    }
}