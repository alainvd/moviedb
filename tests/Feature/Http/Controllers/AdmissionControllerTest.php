<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Admission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AdmissionController
 */
class AdmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $admissions = Admission::factory()->count(3)->create();

        $response = $this->get(route('admission.index'));

        $response->assertOk();
        $response->assertViewIs('admission.index');
        $response->assertViewHas('admissions');
    }
}
