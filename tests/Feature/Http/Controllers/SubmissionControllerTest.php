<?php

namespace Tests\Feature\Http\Controllers;

use App\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubmissionController
 */
class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $submissions = Submission::factory()->count(3)->create();

        $response = $this->get(route('submission.index'));

        $response->assertOk();
        $response->assertViewIs('submission.index');
        $response->assertViewHas('submissions');
    }
}
