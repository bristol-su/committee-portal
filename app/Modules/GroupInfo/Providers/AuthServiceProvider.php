<?php

namespace App\Modules\GroupInfo\Providers;

use App\Traits\AuthorizesUsers;
use App\Traits\FiltersPermissions;
use App\Traits\OverridesGates;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class AuthServiceProvider extends ServiceProvider
{

    use AuthorizesUsers, OverridesGates;

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
        $this->disableExcept('GroupInfo', ['groupinfo', 'presidenthandover', 'exitingtreasurer']);

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
