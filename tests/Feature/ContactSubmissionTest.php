<?php

namespace Tests\Feature;

use App\Models\Centre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_loads(): void
    {
        $this->get(route('contact.index'))->assertOk();
    }

    public function test_valid_contact_message_can_be_submitted(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), [
            'name' => 'John Smith',
            'phone' => '9876543210',
            'email' => 'john@example.com',
            'message' => 'I would like to know more about cochlear implants.',
            'website' => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'John Smith',
            'email' => 'john@example.com',
        ]);
    }

    public function test_contact_requires_name_phone_email_and_message(): void
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'phone', 'email', 'message']);
        $this->assertDatabaseCount('contact_submissions', 0);
    }
}
