<?php

namespace App\Modules\FurtherInformation\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;

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
        Gate::define('furtherinformation.module.isVisible', function(User $user) {
            // TODO Will this work next year with the same tags?
            return ($this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
                || $this->groupHasTag($user, 'we_are_bristol', 'applied');

        });

        // Is the module active?
        Gate::define('furtherinformation.module.isActive', function(User $user) {
            return $user->can('furtherinformation.module.isVisible');
        });

        Gate::define('furtherinformation.view', function(User $user) {
            return $user->can('furtherinformation.module.isVisible');
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
