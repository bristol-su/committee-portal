<?php

namespace App\Modules\ExternalAccounts\Providers;

use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
use App\User;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('.reaffiliation.isMandatory', function(User $user) {
        });

        Gate::define('.reaffiliation.isResponsible', function(User $user) {
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
