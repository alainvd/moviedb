<?php

namespace Tests\Feature\Http\Controllers;

use App\Call;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CallController
 */
class CallControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $calls = Call::factory()->count(3)->create();

        $response = $this->get(route('call.index'));

        $response->assertOk();
        $response->assertViewIs('call.index');
        $response->assertViewHas('calls');
    }
}
