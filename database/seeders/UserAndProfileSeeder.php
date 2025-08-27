<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Veterinarian;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class UserAndProfileSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin User
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'admin@vetbook.com',
            'password' => Hash::make('secret123'),
            'role'     => 'admin',
        ]);

        // 2. Owner User + Profile
        $ownerUser = User::create([
            'name'     => 'Jane Owner',
            'email'    => 'jane.owner@vetbook.com',
            'password' => Hash::make('secret123'),
            'role'     => 'owner',
        ]);

        Owner::create([
            'user_id'  => $ownerUser->id,
            'name'     => 'Jane Owner',
            'email'    => 'jane.owner@vetbook.com',
            'phone'    => '0241234567',
            'address'  => '12 Accra Street',
        ]);

        // 3. Veterinarian User + Profile
        $vetUser = User::create([
            'name'     => 'Dr. Sam Vet',
            'email'    => 'sam.vet@vetbook.com',
            'password' => Hash::make('secret123'),
            'role'     => 'veterinarian',
        ]);

        Veterinarian::create([
            'user_id'         => $vetUser->id,
            'name'            => 'Dr. Sam Vet',
            'email'           => 'sam.vet@vetbook.com',
            'license_number'  => 'VET-1234',
            'specialization'  => 'Dermatology',
        ]);
    }
}