<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChecklistController
 */
class ChecklistControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $checklists = Checklist::factory()->count(3)->create();

        $response = $this->get(route('checklist.index'));

        $response->assertOk();
        $response->assertViewIs('checklist.index');
        $response->assertViewHas('checklists');
    }
}
