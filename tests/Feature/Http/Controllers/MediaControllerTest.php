<?php

namespace Tests\Feature\Http\Controllers;

use App\Media;
use App\Movie;
use App\VideoGame;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MediaController
 */
class MediaControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $movies = Movie::factory()->count(5)->create();
        $videogames = VideoGame::factory()->count(5)->create();
        $media = Media::factory()->count(3)->create();

        $response = $this->get(route('media.index'));

        $response->assertOk();
        $response->assertViewIs('media.index');
        $response->assertViewHas('medium');
    }
}
