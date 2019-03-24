<?php

namespace App\Modules\Presentation\Providers;

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
    public function register()
    {
        // Is the module visible?
        Gate::define('presentation.module.isVisible', function(User $user) {
            return ($this->usersCurrentGroupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
                || $this->usersCurrentGroupHasTag($user, 'we_are_bristol', 'applied');
        });

        // Is the module active?
        Gate::define('presentation.module.isActive', function(User $user) {
            return $user->can('presentation.module.isVisible');
        });

        Gate::define('presentation.view', function(User $user) {
            return $user->can('presentation.module.isVisible');
        });

        // Who can upload an exec summary
        Gate::define('presentation.upload', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->hasPresidentialPosition();
        });

        // Who can upload an exec summary
        Gate::define('presentation.download', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->can('presentation.module.isVisible');
        });

        Gate::define('presentation.post-note', function(User $user) {
            return $user->can('presentation.module.isVisible');
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
