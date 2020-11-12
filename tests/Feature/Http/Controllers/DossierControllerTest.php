<?php

namespace Tests\Feature\Http\Controllers;

use App\Dossier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DossierController
 */
class DossierControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $dossiers = Dossier::factory()->count(3)->create();

        $response = $this->get(route('dossier.index'));

        $response->assertOk();
        $response->assertViewIs('dossier.index');
        $response->assertViewHas('dossiers');
    }
}
