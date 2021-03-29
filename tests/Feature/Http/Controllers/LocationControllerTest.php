<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LocationController
 */
class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $locations = Location::factory()->count(3)->create();

        $response = $this->get(route('location.index'));

        $response->assertOk();
        $response->assertViewIs('location.index');
        $response->assertViewHas('locations');
    }
}
