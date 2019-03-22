<?php

namespace App\Modules\PresidentHandover\Providers;

use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
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
        // Is the module visible?
        Gate::define('presidenthandover.module.isVisible', function (User $user) {
            return true;
        });

        // Is the module active?
        Gate::define('presidenthandover.module.isActive', function (User $user) {
            return $user->can('presidenthandover.module.isVisible');
        });

        Gate::define('presidenthandover.view', function (User $user) {
            return $user->can('presentation.module.isVisible');
        });

        Gate::define('presidenthandover.view-admin', function (User $user) {
            return $user->can('presentation.module.isVisible');
        });

        // Can a president be submitted?
        Gate::define('presidenthandover.submit', function (User $user) {

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
