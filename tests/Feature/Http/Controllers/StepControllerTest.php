<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StepController
 */
class StepControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $steps = Step::factory()->count(3)->create();

        $response = $this->get(route('step.index'));

        $response->assertOk();
        $response->assertViewIs('step.index');
        $response->assertViewHas('steps');
    }
}
