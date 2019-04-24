<?php

namespace App\Modules\NGB\Providers;


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
        Gate::define('ngb.module.isVisible', function(User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'ngb_safety_statement');
        });

        Gate::define('ngb.module.isActive', function(User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'ngb_safety_statement');
        });

        Gate::define('ngb.reaffiliation.isMandatory', function(User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'ngb_safety_statement');
        });

        Gate::define('ngb.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user) && $this->studentIsNewCommittee($user);
        });

        Gate::define('ngb.view', function(User $user) {
            return true;
        });

        Gate::define('ngb.submit', function(User $user) {
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
