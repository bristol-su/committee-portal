<?php

namespace App\Modules\GroupInfo\Providers;

use App\Traits\AuthorizesUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    use AuthorizesUsers;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Gate::define('groupinfo.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('groupinfo.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('groupinfo.reaffiliation.isMandatory', function(User $user) {
            return true;
        });

        Gate::define('groupinfo.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('groupinfo.view', function(User $user) {
            return true;
        });

        Gate::define('groupinfo.submit', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
