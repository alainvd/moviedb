<?php

namespace Tests\Feature\Http\Controllers;

use App\Audience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AudienceController
 */
class AudienceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $audiences = Audience::factory()->count(3)->create();

        $response = $this->get(route('audience.index'));

        $response->assertOk();
        $response->assertViewIs('audience.index');
        $response->assertViewHas('audiences');
    }
}
