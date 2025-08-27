<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_admin_user_only()
    {
        $this->withoutMiddleware();

        $payload = [
            'name'                  => 'Alice Admin',
            'email'                 => 'alice@vet.com',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
            'role'                  => 'admin',
        ];

        $response = $this->post(route('admin.users.store'), $payload);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', [
            'email' => 'alice@vet.com',
            'role'  => 'admin',
        ]);

        // No owner or veterinarian records
        $this->assertDatabaseCount('owners', 0);
        $this->assertDatabaseCount('veterinarians', 0);
    }

    /** @test */
    public function it_creates_an_owner_and_owner_record()
    {
        $this->withoutMiddleware();

        $payload = [
            'name'                  => 'Bob Owner',
            'email'                 => 'bob@owner.com',
            'password'              => 'ownerpass',
            'password_confirmation' => 'ownerpass',
            'role'                  => 'owner',
            'owner_phone'           => '555-0001',
            'owner_address'         => '123 Pet Lane',
        ];

        $response = $this->post(route('admin.users.store'), $payload);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', [
            'email' => 'bob@owner.com',
            'role'  => 'owner',
        ]);

        $user = User::where('email', 'bob@owner.com')->first();
        $this->assertNotNull($user);

        $this->assertDatabaseHas('owners', [
            'user_id' => $user->id,
            'phone'   => '555-0001',
            'address' => '123 Pet Lane',
        ]);

        $this->assertDatabaseCount('veterinarians', 0);
    }

    /** @test */
    public function it_creates_a_veterinarian_and_veterinarian_record()
    {
        $this->withoutMiddleware();

        $payload = [
            'name'                  => 'Dr. Vet',
            'email'                 => 'dr.vet@clinic.com',
            'password'              => 'vetpass123',
            'password_confirmation' => 'vetpass123',
            'role'                  => 'veterinarian',
            'vet_name'              => 'Dr. Vetsworth',
            'vet_phone'             => '555-0002',
            'license_number'        => 'LIC-2025-ABC',
            'specialization'        => 'Dentistry',
        ];

        $response = $this->post(route('admin.users.store'), $payload);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', [
            'email' => 'dr.vet@clinic.com',
            'role'  => 'veterinarian',
        ]);

        $user = User::where('email', 'dr.vet@clinic.com')->first();
        $this->assertNotNull($user);

        $this->assertDatabaseHas('veterinarians', [
            'user_id'        => $user->id,
            'name'           => 'Dr. Vetsworth',
            'phone'          => '555-0002',
            'license_number' => 'LIC-2025-ABC',
            'specialization' => 'Dentistry',
        ]);

        $this->assertDatabaseCount('owners', 0);
    }
}