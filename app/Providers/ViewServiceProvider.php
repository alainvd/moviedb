<?php

namespace App\Providers;

use App\Audience;
use App\Genre;
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
            'livewire.movie-detail-form',
            'App\Http\View\Composers\MovieDetailsFormComposer',
        );
        View::composer(
            'livewire.movie-dev-previous-form',
            'App\Http\View\Composers\MovieDevPreviousFormComposer',
        );
    }
}
