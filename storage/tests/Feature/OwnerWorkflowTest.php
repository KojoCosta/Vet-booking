<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OwnerWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_filters_and_sorting()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Owner::factory()->count(5)->create();

        $response = $this->actingAs($user)
                         ->get('/owners?q=John&sort=first_name|asc');

        $response->assertStatus(200);
        $response->assertSee('Owners');
    }

    public function test_show_owner_details()
    {
        $user  = User::factory()->create(['role' => 'staff']);
        $owner = Owner::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
                         ->get(route('owners.show', $owner));

        $response->assertStatus(200);
        $response->assertSee($owner->first_name);
    }

    public function test_export_csv_download()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Owner::factory()->count(3)->create();

        $response = $this->actingAs($user)
                         ->get(route('owners.export'));

        $response->assertStatus(200);
        $response->assertHeader('content-disposition', 'attachment; filename=owners.csv');
    }
}