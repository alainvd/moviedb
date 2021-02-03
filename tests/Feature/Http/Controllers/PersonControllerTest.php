<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PersonController
 */
class PersonControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $people = Person::factory()->count(3)->create();

        $response = $this->get(route('person.index'));

        $response->assertOk();
        $response->assertViewIs('person.index');
        $response->assertViewHas('persons');
    }
}
