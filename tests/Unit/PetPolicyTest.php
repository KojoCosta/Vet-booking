<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Pet;
use App\Policies\PetPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PetPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_any_pet()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $policy = new PetPolicy;
        $this->assertTrue($policy->viewAny($admin));
    }

    public function test_regular_user_cannot_delete_pet()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $pet  = Pet::factory()->create();

        $policy = new PetPolicy;
        $this->assertFalse($policy->delete($user, $pet));
    }
}