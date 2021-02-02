<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Crew;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CrewController
 */
class CrewControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $crews = Crew::factory()->count(3)->create();

        $response = $this->get(route('crew.index'));

        $response->assertOk();
        $response->assertViewIs('crew.index');
        // $response->assertViewHas('crews');
    }
}
