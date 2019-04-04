<?php

namespace App\Modules\GroupInfo\Providers;

use App\Traits\AuthorizesUsers;
use App\Traits\FiltersPermissions;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    use AuthorizesUsers, FiltersPermissions;

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
        /*
         * Don't allow access to any modules until this is complete (for anyone in the new committee)
         */
        Gate::before(function(User $user, $ability) {
            // Match any modules which
            if($this->overrideIsActive($ability, ['groupinfo']) && !$user->isAdmin()) {
                return false;
            }
            return null;
        });

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
