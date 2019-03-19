<?php

namespace App\Modules\WABBudget\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
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
    public function register()
    {
        // Is the module visible?
        Gate::define('wabbudget.module.isVisible', function(User $user) {
            return ($this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
            || $this->groupHasTag($user, 'we_are_bristol', 'applied');
        });

        // Is the module active?
        Gate::define('wabbudget.module.isActive', function(User $user) {
            return $user->can('wabbudget.module.isVisible');
        });

        Gate::define('wabbudget.view', function(User $user) {
            return $user->can('wabbudget.module.isVisible');
        });

        // Who can upload an exec summary
        Gate::define('wabbudget.upload', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->hasPresidentialPosition();
        });

        // Who can upload an exec summary
        Gate::define('wabbudget.download', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->can('wabbudget.module.isVisible');
        });

        Gate::define('wabbudget.post-note', function(User $user) {
            return $user->can('wabbudget.module.isVisible');
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
