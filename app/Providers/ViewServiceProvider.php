<?php

namespace App\Providers;

use App\Models\Audience;
use App\Models\Genre;
use App\Http\View\Composers\DistributorsComposer;
use App\Http\View\Composers\MovieFicheFormComposer;
use App\Models\Country;
use App\Models\Language;
use App\Models\Status;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'livewire.table-edit-example-memory',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.table-edit-example-simple',
            MovieFicheFormComposer::class,
        );

        View::composer(
            'livewire.movie-dist-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.movie-dev-previous-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.movie-dev-current-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.movie-tv-form',
            'App\Http\View\Composers\MovieFicheFormComposer',
        );
        View::composer(
            'livewire.video-game-previous-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.dossiers.activities.distributors',
            DistributorsComposer::class
        );
        View::composer(
            'livewire.table-edit-movie-producers',
            MovieFicheFormComposer::class
        );
        View::composer(
            'livewire.dossiers.movie-wizard',
            MovieFicheFormComposer::class
        );
    }
}
