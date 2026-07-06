<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Centre;
use App\Models\Specialist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AppointmentSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_appointment_page_loads(): void
    {
        $this->get(route('appointment.create'))->assertOk();
    }

    public function test_valid_appointment_can_be_submitted(): void
    {
        Mail::fake();

        $centre = Centre::factory()->create();

        $response = $this->post(route('appointment.store'), [
            'name' => 'Jane Doe',
            'phone' => '9876543210',
            'email' => 'jane@example.com',
            'centre_id' => $centre->id,
            'department' => 'ENT',
            'website' => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('appointments', [
            'name' => 'Jane Doe',
            'phone' => '9876543210',
            'centre_id' => $centre->id,
        ]);
    }

    public function test_appointment_requires_name_phone_and_centre(): void
    {
        $response = $this->post(route('appointment.store'), []);

        $response->assertSessionHasErrors(['name', 'phone', 'centre_id']);
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_appointment_honeypot_field_rejects_bots(): void
    {
        $centre = Centre::factory()->create();

        $response = $this->post(route('appointment.store'), [
            'name' => 'Bot',
            'phone' => '9876543210',
            'centre_id' => $centre->id,
            'department' => 'ENT',
            'website' => 'https://spam.example.com',
        ]);

        $response->assertSessionHasErrors('website');
        $this->assertDatabaseCount('appointments', 0);
    }
}
