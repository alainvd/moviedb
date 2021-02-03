<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GenreController
 */
class GenreControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $genres = Genre::factory()->count(3)->create();

        $response = $this->get(route('genre.index'));

        $response->assertOk();
        $response->assertViewIs('genre.index');
        $response->assertViewHas('genres');
    }
}
