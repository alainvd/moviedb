<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SalesAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SalesAgentController
 */
class SalesAgentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $salesAgents = SalesAgent::factory()->count(3)->create();

        $response = $this->get(route('sales-agent.index'));

        $response->assertOk();
        $response->assertViewIs('sales_agent.index');
        $response->assertViewHas('salesAgents');
    }
}
