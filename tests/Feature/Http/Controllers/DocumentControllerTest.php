<?php

namespace Tests\Feature\Http\Controllers;

use App\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DocumentController
 */
class DocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $Documents = Document::factory()->count(3)->create();

        $response = $this->get(route('document.index'));

        $response->assertOk();
        $response->assertViewIs('documents.index');
        $response->assertViewHas('Documents');
    }
}
