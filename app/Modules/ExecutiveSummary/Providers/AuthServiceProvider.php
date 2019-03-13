<?php

namespace App\Modules\ExecutiveSummary\Providers;

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
        //
    }

    public function boot()
    {
        // Is the module visible?
        Gate::define('executivesummary.module.isVisible', function(User $user) {
            return ($this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
                || $this->groupHasTag($user, 'we_are_bristol', 'applied');
        });

        // Is the module active?
        Gate::define('executivesummary.module.isActive', function(User $user) {
            return $user->can('executivesummary.module.isVisible');

        });

        // Who can upload an exec summary
        Gate::define('executivesummary.upload', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->hasPresidentialPosition();
        });

        Gate::define('executivesummary.view', function(User $user) {
            return $user->can('executivesummary.module.isVisible');
        });

        // Who can upload an exec summary
        Gate::define('executivesummary.download', function(User $user) {
            // TODO Old committee over changeover period is hard
            return $user->can('executivesummary.module.isVisible');
        });

        Gate::define('executivesummary.post-note', function(User $user) {
            return $user->can('executivesummary.module.isVisible');
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
