<?php

namespace App\Providers;


use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::macro('notify', function ($text, $type = 'success') {
            $this->dispatchBrowserEvent('notify', ['text'=>$text, 'type'=>$type]);
        });

        Paginator::useTailwind();
    }
}
