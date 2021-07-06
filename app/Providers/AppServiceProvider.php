<?php

namespace App\Providers;


use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class,
            \App\Http\Controllers\Admin\UserCrudController::class
        );

        Component::macro('notify', function ($text, $type = 'success') {
            $this->dispatchBrowserEvent('notify', ['text'=>$text, 'type'=>$type]);
        });

        Blade::directive('amount', function ($amount) {
            return "<?php echo e(amount($amount)); ?>";
        });

        Blade::directive('euro', function ($amount) {
            return "<?php echo e(euro($amount)); ?>";
        });

        Paginator::useTailwind();
    }

}
