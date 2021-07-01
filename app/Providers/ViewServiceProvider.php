<?php

namespace App\Providers;

use App\Http\View\Composers\DashboardComposer;
use App\Http\View\Composers\DistributorsComposer;
use App\Http\View\Composers\MovieFicheFormComposer;
use App\Http\View\Composers\SearchComposer;
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
            'livewire.movie-dev-prev-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.movie-dev-current-form',
            MovieFicheFormComposer::class,
        );
        View::composer(
            'livewire.movie-tv-form',
            MovieFicheFormComposer::class,
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

        View::composer('livewire.search-page', SearchComposer::class);

        View::composer(
            'livewire.dashboard.dials',
            DashboardComposer::class
        );
    }
}
