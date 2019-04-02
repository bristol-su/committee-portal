<?php

namespace App\Modules\Constitution\Providers;

use App\Modules\BaseModule\Providers\BaseAuthServiceProvider;
use App\Traits\AuthorizesUsers;
use App\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends BaseAuthServiceProvider
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
        Gate::define('budget.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('budget.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('budget.reaffiliation.isMandatory', function(User $user) {
            return $this->groupHasTag($user, 'financial_risk', 'high');
        });

        Gate::define('budget.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasTreasurerPosition($user)
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
