<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_admin_resources(): void
    {
        $user = User::factory()->create();

        foreach ([
            '/admin/centres',
            '/admin/specialists',
            '/admin/treatments',
            '/admin/condition-treateds',
            '/admin/job-openings',
            '/admin/gallery-items',
            '/admin/testimonial-videos',
            '/admin/appointments',
            '/admin/contact-submissions',
        ] as $path) {
            $this->actingAs($user)->get($path)->assertOk();
        }
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/centres')->assertRedirect('/admin/login');
    }
}
