<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\ServiceLog;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceLogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_service_log_creation_triggers_audit_log()
    {
        Storage::fake('public');

        $user = User::factory()->create(['crp_id' => 'A']);
        $this->actingAs($user);

        $client = Client::factory()->create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
        ]);

        $file = UploadedFile::fake()->create('log.txt', 100);

        $response = $this->postJson('/service-logs/store', [
            'client' => $client->id,
            'notes'  => 'Test service log',
            'file'   => $file,
        ]);

        // Assert response success
        $response->assertStatus(200)
                 ->assertJson(['success' => 'created successfully!']);

        Storage::disk('public')->assertExists('service_logs/' . $file->hashName());

        $this->assertDatabaseHas('service_logs', [
            'client_id' => $client->id,
            'notes'     => 'Test service log',
            'file_path' => 'service_logs/' . $file->hashName(),
        ]);

        $serviceLog = ServiceLog::first();

        $this->assertDatabaseHas('audit_logs', [
            'crp_id'     => $user->crp_id,
            'action'     => 'created',
            'model_type' => 'ServiceLog',
            'model_id'   => $serviceLog->id,
        ]);

        $audit = AuditLog::first();
        $this->assertEquals('John Doe', $audit->new_values['client']);
        $this->assertEquals('Test service log', $audit->new_values['notes']);
    }
}
