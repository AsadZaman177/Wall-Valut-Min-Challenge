<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncryptionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_ssn_encrypted()
    {
        $user = User::factory()->create(['crp_id' => 'A']);

        $this->actingAs($user);
        Client::factory()->create([
            'first_name' => 'A',
            'last_name'  => 'B',
            'ssn'        => '123456',
            'dob'        => '2000-01-01',
        ]);

        $raw = DB::table('clients')->first();

        $this->assertNotEquals('123456', $raw->ssn);

        $client = Client::first();
        $this->assertEquals('123456', $client->ssn);
    }
}
