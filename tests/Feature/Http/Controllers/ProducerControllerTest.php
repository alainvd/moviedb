<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Producer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProducerController
 */
class ProducerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $producers = Producer::factory()->count(3)->create();

        $response = $this->get(route('producer.index'));

        $response->assertOk();
        $response->assertViewIs('producer.index');
        $response->assertViewHas('producers');
    }
}
