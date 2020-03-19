<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You must be a super administrator.');
        });
        Gate::define('isEditor', function ($user) {
            return $user->isEditor()
                ? Response::allow()
                : Response::deny('You must be a super administrator.');
        });
         Gate::define('isStatus', function ($user) {
            return $user->isStatus()
                ? Response::allow()
                : Response::deny('You must be a super administrator.');
        });
    }
}
