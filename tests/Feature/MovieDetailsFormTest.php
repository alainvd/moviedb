<?php

namespace Tests\Feature;

use App\Audience;
use App\Dossier;
use App\Genre;
use App\Http\Livewire\MovieDetailForm;
use App\Media;
use App\Models\Country;
use App\Models\Fiche;
use App\Models\Status;
use App\Movie;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MovieDetailsFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function form_is_visible()
    {
        $this->get('/fiches/dist')->assertSeeLivewire('movie-detail-form');
    }

    /** @test */
    public function an_applicant_can_create_a_new_fiche()
    {
        list(
            $fiche,
            $movie,
            $media,
            $user
        ) = $this->init('applicant');

        $this->actingAs($user);

        Livewire::test(MovieDetailForm::class)
            ->assertSet('isNew', true)
            ->set('movie.original_title', $movie->original_title)
            ->set('fiche.status_id', $fiche->status_id)
            ->set('movie.film_country_of_origin', $movie->film_country_of_origin)
            ->set('movie.year_of_copyright', $movie->year_of_copyright)
            ->set('movie.film_type', $movie->film_type)
            ->set('movie.imdb_url', $movie->imdb_url)
            ->set('movie.film_length', $movie->film_length)
            ->set('movie.film_format', $movie->film_format)
            ->set('movie.isan', $movie->isan)
            ->set('movie.synopsis', $movie->synopsis)
            ->set('movie.photography_start', $movie->photography_start)
            ->set('movie.photography_end', $movie->photography_end)
            ->set('media.audience_id', $media->audience_id)
            ->set('media.genre_id', $media->genre_id)
            ->set('media.delivery_platform_id', $media->delivery_platform_id)
            ->call('submit');

        $this->assertDatabaseHas('movies', $movie->toArray())
            ->assertDatabaseHas('media', $media->toArray())
            ->assertDatabaseHas('fiches', $fiche->toArray());
    }

    /** @test */
    // public function an_applicant_cannot_view_other_fiches()
    // {

    // }

    // /** @test */
    public function an_editor_can_edit_a_fiche()
    {
        list(
            $fiche,
            $movie,
            $media,
            $user
        ) = $this->init('applicant');

        // Save the prepared entities from edit
        $movie->save();
        $media->grantable_id = $movie->id;
        $media->grantable()->save($movie);
        $media->save();
        $fiche->media_id = $media->id;
        $fiche->save();

        // Edited fields
        $movie->original_title = 'Some new title';
        $fiche->status_id = Status::where('id', '!=', $fiche->status_id)->get()->random()->id;

        $this->actingAs($user);

        Livewire::test(MovieDetailForm::class, ['fiche' => $fiche])
            ->assertSet('isNew', false)
            ->set('movie.original_title', $movie->original_title)
            ->set('fiche.status_id', $fiche->status_id)
            ->call('submit');

        // Remove media key for some reason
        $fiche = $fiche->toArray();
        unset($fiche['media']);

        $this->assertDatabaseHas('fiches', $fiche)
            ->assertDatabaseHas('movie', $movie->toArray());
    }

    protected function init(string $role): array
    {
        Role::create(['name' => 'applicant']);
        Role::create(['name' => 'editor']);
        Audience::factory(10)->create();
        Country::factory(25)->create();
        Genre::factory(10)->create();
        Status::factory(10)->create();
        Media::factory()->create();

        $user = User::factory()->create(
            ['eu_login_username' => "mediadb-{$role}"]
        )->assignRole($role);

        $movie = Movie::factory()->make([
            'eidr' => null,
            'shooting_start' => null,
            'shooting_end' => null,
            'european_nationality_flag' => null,
        ]);
        $media = Media::make([
            'grantable_type' => 'App\Movie',
            'title' => $movie->original_title,
            'audience_id' => Audience::all()->random()->id,
            'genre_id' => Genre::all()->random()->id,
            'delivery_platform_id' => 1
        ]);
        $fiche = Fiche::make([
            'created_by' => $user->id,
            'status_id' => Status::all()->random()->id,
        ]);

        return [$fiche, $movie, $media, $user];
    }
}
