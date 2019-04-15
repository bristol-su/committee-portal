<?php

namespace App\Modules\MainContacts\Providers;

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
        Gate::define('maincontacts.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('maincontacts.module.isActive', function(User $user) {
            // TODO GATE BEFORE CommitteeDetails
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE TaskAllocation
            return true;
        });

        Gate::define('maincontacts.reaffiliation.isMandatory', function(User $user) {
            return true;
        });

        Gate::define('maincontacts.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('maincontacts.submit', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('maincontacts.view', function(User $user) {
            return true;
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
