<?php

namespace Tests\Feature;

use App\Models\Centre;
use App\Models\ConditionTreated;
use App\Models\Specialist;
use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_static_pages_load_successfully(): void
    {
        foreach ([
            'home',
            'about.index',
            'about.chairman',
            'treatments.index',
            'conditions.index',
            'specialists.index',
            'centres.index',
            'appointment.create',
            'contact.index',
            'careers.index',
            'gallery.index',
        ] as $routeName) {
            $this->get(route($routeName))->assertOk();
        }
    }

    public function test_treatment_detail_page_loads(): void
    {
        $treatment = Treatment::factory()->create();

        $this->get(route('treatments.show', $treatment))->assertOk();
    }

    public function test_condition_detail_page_loads(): void
    {
        $condition = ConditionTreated::factory()->create();

        $this->get(route('conditions.show', $condition))->assertOk();
    }

    public function test_specialist_detail_page_loads(): void
    {
        $specialist = Specialist::factory()->create();
        $centre = Centre::factory()->create();
        $specialist->centres()->attach($centre);

        $this->get(route('specialists.show', $specialist))->assertOk();
    }
}
