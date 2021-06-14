<?php

namespace App\Providers;

use App\Models\Dossier;
use App\Models\User;
use App\Policies\DossierPolicy;
use App\Policies\FichePolicy;
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
        Fiche::class => FichePolicy::class,
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
                if (cas()->isAuthenticated()) {
                    return User::firstOrCreateByAttributes(cas()->getAttributes());
                } else return null;
            } else return null;
        });
    }
}
