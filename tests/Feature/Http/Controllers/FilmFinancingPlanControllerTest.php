<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FilmFinancingPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FilmFinancingPlanController
 */
class FilmFinancingPlanControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $filmFinancingPlans = FilmFinancingPlan::factory()->count(3)->create();

        $response = $this->get(route('film-financing-plan.index'));

        $response->assertOk();
        $response->assertViewIs('film_financing_plans.index');
        $response->assertViewHas('filmFinancingPlans');
    }
}
