<?php
// tests/Unit/UserServiceTest.php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected UserService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(UserService::class);
    }

    public function testCreatesAdminOnlyUser()
    {
        $data = [
            'name'     => 'Alice Admin',
            'email'    => 'alice@vet.com',
            'password' => 'password123',
            'role'     => 'admin',
        ];

        $user = $this->service->create($data);

        $this->assertDatabaseHas('users', [
            'id'    => $user->id,
            'email' => 'alice@vet.com',
            'role'  => 'admin',
        ]);

        $this->assertNull($user->owner);
        $this->assertNull($user->veterinarian);
    }

    public function testCreatesOwnerWithRelatedRecord()
    {
        $data = [
            'name'          => 'Bob Owner',
            'email'         => 'bob@owner.com',
            'password'      => 'securepass',
            'role'          => 'owner',
            'owner_phone'   => '123-4567',
            'owner_address' => '42 Pet Lane',
        ];

        $user = $this->service->create($data);

        $this->assertDatabaseHas('owners', [
            'user_id' => $user->id,
            'phone'   => '123-4567',
        ]);
    }

    public function testCreatesVeterinarianWithRelatedRecord()
    {
        $data = [
            'name'           => 'Dr. Vet',
            'email'          => 'drvet@clinic.com',
            'password'       => 'vetpassword',
            'role'           => 'veterinarian',
            'vet_name'       => 'Dr. Vetsworth',
            'vet_phone'      => '987-6543',
            'license_number' => 'LIC-2025-0001',
            'specialization' => 'Surgery',
        ];

        $user = $this->service->create($data);

        $this->assertDatabaseHas('veterinarians', [
            'user_id'        => $user->id,
            'license_number' => 'LIC-2025-0001',
        ]);
    }
        // tests/Unit/UserServiceTest.php
    public function test_owner_creation_inserts_both_tables()
    {
        $service = new UserService(/*… dependencies …*/);
        $user    = $service->create($ownerPayload);
        $this->assertDatabaseHas('owners', ['user_id' => $user->id]);
    }
}