<?php

namespace App\Modules\TaskAllocation\Providers;

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
        Gate::define('taskallocation.module.isVisible', function(User $user) {
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE CommitteeDetails
            return true;
        });

        Gate::define('taskallocation.module.isActive', function(User $user) {
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE CommitteeDetails
            return true;
        });

        Gate::define('taskallocation.reaffiliation.isMandatory', function(User $user) {
            return true;
        });


        Gate::define('taskallocation.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('taskallocation.submit', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('taskallocation.view', function(User $user) {
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
