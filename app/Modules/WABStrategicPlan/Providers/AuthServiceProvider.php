<?php

namespace App\Modules\WABStrategicPlan\Providers;

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
        Gate::define('wabstrategicplan.module.isVisible', function(User $user) {
            return $this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register');
        });

        Gate::define('wabstrategicplan.module.isActive', function(User $user) {
            return $this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register');
        });

        Gate::define('wabstrategicplan.reaffiliation.isMandatory', function(User $user) {
            return false;
        });

        Gate::define('wabstrategicplan.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsOldCommittee($user);
        });

        Gate::define('wabstrategicplan.upload', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsOldCommittee($user);
        });

        Gate::define('wabstrategicplan.download', function(User $user) {
            return $this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register');
        });

        Gate::define('wabstrategicplan.view', function(User $user) {
            return $this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register');
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
