<?php

namespace App\Modules\LibelDefamation\Providers;

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
        Gate::define('libeldefamation.module.isVisible', function(User $user) {
                return $this->groupHasTag($user, 'reaffiliation_tasks', 'libel_defamation_awareness');
        });

        Gate::define('libeldefamation.module.isActive', function(User $user) {
            return false;
            // TODO GATE BEFORE CommitteeDetails
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE TaskAllocation
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'libel_defamation_awareness');
        });

        Gate::define('libeldefamation.reaffiliation.isMandatory', function(User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'libel_defamation_awareness');
        });

        Gate::define('libeldefamation.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user);
        });

        Gate::define('libeldefamation.view', function(User $user) {
            return true;
        });

        Gate::define('libeldefamation.submit', function(User $user) {
            return $this->studentHasPresidentialPosition($user);
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
