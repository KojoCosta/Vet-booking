<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PetAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_pet_index()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
             ->get('/pets')
             ->assertStatus(403);
    }
}