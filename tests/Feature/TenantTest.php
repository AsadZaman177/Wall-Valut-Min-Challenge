<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_tenant_isolation()
    {
        $userA = User::factory()->create(['crp_id' => 'A']);
        $userB = User::factory()->create(['crp_id' => 'B']);

        $this->actingAs($userA);
        Client::factory()->create([
            'first_name' => 'A',
            'last_name'  => 'A',
            'ssn'        => '123',
            'dob'        => '2000-01-01',
        ]);

        $this->actingAs($userB);
        $this->assertDatabaseMissing('clients', [
            'first_name' => 'A',
            'crp_id'     => 'B',
        ]);

        $this->actingAs($userA);
        $this->assertDatabaseHas('clients', [
            'first_name' => 'A',
            'crp_id'     => 'A',
        ]);
    }
}
