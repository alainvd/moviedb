<?php

namespace Tests\Feature\Http\Models;

use App\Models\Audience;
use App\Models\Crew;
use App\Models\FilmFinancingPlan;
use App\Models\Distributor;
use App\Models\Language;
use App\Models\Movie;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AudienceController
 */
class MoviesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_display_movie_fields()
    {
        $movie = Movie::factory()->create();

        $this->assertNotNull($movie);

        //Create crew data
        $person = Person::factory()->create();
        Crew::factory()->create(["person_id" => $person->id, "movie_id" => $movie->id]);

        //Create and link Distributor
        $distributor = Distributor::factory()->create();
        $movie->distributors()->save($distributor);

        //Create and Link Film Financing Plan
        $financingPlan = FilmFinancingPlan::factory()->create();
        $movie->filmFinancingPlans()->save($financingPlan);

        //Create and link languages
        $language = Language::factory()->create();
        $movie->languages()->save($language);



        $response = $this->get(route('movie_show',['movie'=>$movie->id]));

        $response->assertOk();
        $response->assertViewIs('movies.show');
        $response->assertViewHas('movie');
        $response->assertSeeText($movie->title);
        $response->assertSeeText($movie->genre->name);
        $response->assertSeeText($movie->audience->name);
        $response->assertSeeText($person->fullname);
        $response->assertSeeText($distributor->name);
        $response->assertSeeText($financingPlan->filename);
        $response->assertSeeText($language->name);
    }
}
