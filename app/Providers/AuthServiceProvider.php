<?php

namespace App\Providers;

use App\Models\Dossier;
use App\Models\User;
use App\Policies\DossierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Dossier::class => DossierPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('movie-db', function ($request) {
            if (session()->get('cas_user')) {
                return User::firstOrCreateByAttributes(cas()->getAttributes());
            } else return null;
        });
    }
}
