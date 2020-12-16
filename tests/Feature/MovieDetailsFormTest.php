<?php

namespace Tests\Feature;

use App\Audience;
use App\Crew;
use App\Dossier;
use App\Genre;
use App\Http\Livewire\MovieDetailForm;
use App\Http\Livewire\TableEditMovieCrews;
use App\Http\Livewire\TableEditMovieProducers;
use App\Http\Livewire\TableEditMovieSalesAgents;
use App\Media;
use App\Models\Country;
use App\Models\Fiche;
use App\Models\Status;
use App\Movie;
use App\Producer;
use App\SalesAgent;
use App\Title;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class MovieDetailsFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public Fiche $fiche;
    public Media $media;
    public Movie $movie;
    public User $user;

    /** @test */
    public function form_is_visible()
    {
        $this->get('/fiches/dist')->assertSeeLivewire('movie-detail-form');
    }

    /** @test */
    public function an_applicant_can_create_a_new_fiche()
    {
        $this->init('applicant');

        $this->actingAs($this->user);

        $this->fillMovieForm()
            ->call('submit');

        $this->assertDatabaseHas('movies', $this->movie->toArray())
            ->assertDatabaseHas('media', $this->media->toArray())
            ->assertDatabaseHas('fiches', $this->fiche->toArray());
    }

    /** @test */
    // public function an_applicant_cannot_view_other_fiches()
    // {

    // }

    // /** @test */
    public function an_editor_can_edit_a_fiche()
    {
        $this->init('editor');

        // Save the prepared entities from edit
        $this->movie->save();
        $this->media->grantable_id = $this->movie->id;
        $this->media->grantable()->save($this->movie);
        $this->media->save();
        $dossier = Dossier::factory()->create();
        $this->fiche->fill([
            'media_id' => $this->media->id,
            'dossier_id' => $dossier->id,
        ])->save();

        // Edited fields
        $newTitle = 'Some new title';
        $newStatus = Status::where('id', '!=', $this->fiche->status_id)
            ->get()->random()->id;

        $this->actingAs($this->user);

        Livewire::test(MovieDetailForm::class, ['fiche' => $this->fiche])
            // test if the form is not new if a model is provided
            ->assertSet('isNew', false)
            ->set('movie.original_title', $newTitle)
            ->set('fiche.status_id', $newStatus)
            ->call('submit');

        $this->assertDatabaseHas('fiches', [
            'id' => $this->fiche->id,
            'media_id' => $this->fiche->media->id,
            'dossier_id' => $dossier->id,
            'status_id' => $newStatus
        ])->assertDatabaseHas('movies', [
            'id' => $this->movie->id,
            'original_title' => $newTitle
        ])->assertDatabaseHas('media', [
            'id' => $this->media->id,
            'title' => $newTitle,
            'grantable_id' => $this->movie->id,
            'grantable_type' => 'App\Movie',
        ]);
    }

    /** @test */
    public function adding_cast_and_crew_displays_them_in_table()
    {
        $this->init('applicant');

        $this->actingAs($this->user);

        // Cast and crew init
        Title::factory(100)->create();

        $this->fillMovieForm();

        $crews = Crew::factory(3)->make();

        foreach ($crews as $crew) {
            $this->addCrew($crew)
                ->assertSee($crew->person->firstname . ' ' . $crew->person->lastname);
        }

    }

    /** @test */
    public function an_applicant_can_add_producers()
    {
        $this->init('applicant');

        $this->actingAs($this->user);

        $this->fillMovieForm();

        $producers = Producer::factory(5)->make();

        foreach ($producers as $producer) {
            Livewire::test(TableEditMovieProducers::class)
                ->set('editing.key', $this->faker->text(10))
                ->set('editing.role', $producer->role)
                ->set('editing.country_id', $producer->country_id)
                ->set('editing.city', $producer->city)
                ->set('editing.media_id', $producer->media_id)
                ->set('editing.share', $producer->share)
                ->set('editing.name', $producer->name)
                ->call('saveItem')
                ->assertSeeInOrder([
                    ucwords($producer->role),
                    $producer->name,
                    $producer->city,
                    $producer->country->name
                ]);
        }
    }

    /** @test */
    public function an_applicant_can_add_sales_agents()
    {
        $this->init('applicant');

        $this->actingAs($this->user);

        $this->fillMovieForm();

        $agents = SalesAgent::factory(5)->make();

        foreach ($agents as $agent) {
            Livewire::test(TableEditMovieSalesAgents::class)
                ->set('editing.key', $this->faker->text(10))
                ->set('editing.name', $agent->name)
                ->set('editing.country_id', $agent->country_id)
                ->set('editing.contact_person', $agent->contact_person)
                ->set('editing.email', $agent->email)
                ->call('saveItem')
                ->assertSeeInOrder([
                    $agent->name,
                    $agent->country->name,
                ])->assertSeeInOrder([ // moved these down because assertion wasn't working
                    // even though they were present in the page in that order
                    $agent->contact_person,
                    $agent->email,
                ]);
        }
    }

    protected function init(string $role): void
    {
        Role::create(['name' => 'applicant']);
        Role::create(['name' => 'editor']);
        Audience::factory(10)->create();
        Country::factory(144)->create();
        Genre::factory(10)->create();
        Status::factory(10)->create();
        Media::factory()->create();

        $this->user = User::factory()->create(
            ['eu_login_username' => "mediadb-{$role}"]
        )->assignRole($role);

        $this->movie = Movie::factory()->make([
            'eidr' => null,
            'shooting_start' => null,
            'shooting_end' => null,
            'european_nationality_flag' => null,
        ]);
        $this->media = Media::make([
            'grantable_type' => 'App\Movie',
            'title' => $this->movie->original_title,
            'audience_id' => Audience::all()->random()->id,
            'genre_id' => Genre::all()->random()->id,
            'delivery_platform_id' => 1
        ]);
        $this->fiche = Fiche::make([
            'created_by' => $this->user->id,
            'status_id' => Status::all()->random()->id,
        ]);
    }

    protected function fillMovieForm()
    {
        return Livewire::test(MovieDetailForm::class)
            ->set('movie.original_title', $this->movie->original_title)
            ->set('fiche.status_id', $this->fiche->status_id)
            ->set('movie.film_country_of_origin', $this->movie->film_country_of_origin)
            ->set('movie.year_of_copyright', $this->movie->year_of_copyright)
            ->set('movie.film_type', $this->movie->film_type)
            ->set('movie.imdb_url', $this->movie->imdb_url)
            ->set('movie.film_length', $this->movie->film_length)
            ->set('movie.film_format', $this->movie->film_format)
            ->set('movie.isan', $this->movie->isan)
            ->set('movie.synopsis', $this->movie->synopsis)
            ->set('movie.photography_start', $this->movie->photography_start->toDateString())
            ->set('movie.photography_end', $this->movie->photography_end)
            ->set('media.audience_id', $this->media->audience_id)
            ->set('media.genre_id', $this->media->genre_id)
            ->set('media.delivery_platform_id', $this->media->delivery_platform_id)
            ->set('movie.total_budget_currency_amount', $this->movie->total_budget_currency_amount)
            ->set('movie.total_budget_currency_code', $this->movie->total_budget_currency_code)
            ->set('movie.total_budget_currency_rate', $this->movie->total_budget_currency_rate)
            ->set('movie.total_budget_euro', $this->movie->total_budget_euro);
    }

    protected function addCrew($crew)
    {
        return Livewire::test(TableEditMovieCrews::class)
            ->set('editing.key', $this->faker->text(10))
            ->set('editing.title_id', $crew->title_id)
            ->set('editing.person.firstname', $crew->person->firstname)
            ->set('editing.person.lastname', $crew->person->lastname)
            ->set('editing.person.gender', $crew->person->gender)
            ->set('editing.person.nationality1', $crew->person->nationality1)
            ->set('editing.person.nationality2', $crew->person->nationality2)
            ->set('editing.person.country_of_residence', $crew->person->country_of_residence)
            ->set('editing.points', 0)
            ->call('saveItem');
    }
}
