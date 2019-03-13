<?php

namespace App\Modules\TierSelection\Providers;

use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
use App\Modules\TierSelection\Entities\Tier;
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
        Gate::define('tierselection.module.isVisible', function(User $user) {
            return ($this->groupHasTag($user, 'we_are_bristol', 'allowed_to_register') && config('portal.we_are_bristol.enabled'))
                || $this->groupHasTag($user, 'we_are_bristol', 'applied');
        });

        // Is the module active?
        Gate::define('tierselection.module.isActive', function(User $user) {
            return $user->can('tierselection.module.isVisible');
        });

        Gate::define('tierselection.view', function(User $user) {
            return $user->can('tierselection.module.isVisible');
        });

        Gate::define('tierselection.submit', function(User $user) {
            return Tier::where([
                'year'=>config('portal.reaffiliation_year'),
                'group_id' => getGroupID()
            ])->count() === 0;
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
