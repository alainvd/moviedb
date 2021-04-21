<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AdmissionsTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AdmissionsTableController
 */
class AdmissionsTableControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $admissionsTables = AdmissionsTable::factory()->count(3)->create();

        $response = $this->get(route('admissions-table.index'));

        $response->assertOk();
        $response->assertViewIs('admissions_table.index');
        $response->assertViewHas('admissionsTables');
    }
}
