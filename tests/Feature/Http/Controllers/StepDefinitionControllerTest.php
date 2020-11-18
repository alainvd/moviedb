<?php

namespace Tests\Feature\Http\Controllers;

use App\StepDefinition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StepDefinitionController
 */
class StepDefinitionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $stepDefinitions = StepDefinition::factory()->count(3)->create();

        $response = $this->get(route('step-definition.index'));

        $response->assertOk();
        $response->assertViewIs('stepdefinitions.index');
        $response->assertViewHas('stepDefinitions');
    }
}
