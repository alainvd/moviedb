<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Title;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TitleController
 */
class TitleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $titles = Title::factory()->count(3)->create();

        $response = $this->get(route('title.index'));

        $response->assertOk();
        $response->assertViewIs('title.index');
        $response->assertViewHas('titles');
    }
}
