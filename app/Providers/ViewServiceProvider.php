<?php

namespace App\Providers;

use App\Audience;
use App\Genre;
use App\Http\View\Composers\DistributorsComposer;
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
            'livewire.movie-dist-form',
            'App\Http\View\Composers\MovieFicheFormComposer',
        );
        View::composer(
            'livewire.movie-dev-previous-form',
            'App\Http\View\Composers\MovieFicheFormComposer',
        );
        View::composer(
            'livewire.movie-dev-current-form',
            'App\Http\View\Composers\MovieFicheFormComposer',
        );
        View::composer(
            'livewire.video-game-previous-form',
            'App\Http\View\Composers\VideoGameFicheFormComposer',
        );
        View::composer(
            'livewire.activities.distributors',
            DistributorsComposer::class
        );
    }
}
