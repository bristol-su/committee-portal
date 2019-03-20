<?php

namespace App\Modules\StrategicPlan\Providers;

use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends BaseAuthServiceProvider
{
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
    // TODO GATE Strategic Plan
    public function register()
    {
        // Is the module visible?
        Gate::define('strategicplan.module.isVisible', function(User $user) {
            return ($this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
                || $this->groupHasTag($user, 'we_are_bristol', 'applied');
        });

        // Is the module active?
        Gate::define('strategicplan.module.isActive', function(User $user) {
            return $user->can('strategicplan.module.isVisible');
        });

        Gate::define('strategicplan.view', function(User $user) {
            return $user->can('strategicplan.module.isVisible');
        });

        // Who can upload an exec summary
        Gate::define('strategicplan.upload', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->hasPresidentialPosition();
        });

        // Who can upload an exec summary
        Gate::define('strategicplan.download', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->can('strategicplan.module.isVisible');
        });

        Gate::define('strategicplan.post-note', function(User $user) {
            return $user->can('strategicplan.module.isVisible');
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
