<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SalesDistributor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SalesDistributorController
 */
class SalesDistributorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $salesDistributors = SalesDistributor::factory()->count(3)->create();

        $response = $this->get(route('sales-distributor.index'));

        $response->assertOk();
        $response->assertViewIs('sales_distributor.index');
        $response->assertViewHas('salesDistributors');
    }
}
