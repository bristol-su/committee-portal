<?php

namespace App\Modules\RiskAssessment\Providers;

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
        Gate::define('riskassessment.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('riskassessment.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('riskassessment.reaffiliation.isMandatory', function(User $user) {
            return true;
        });

        Gate::define('riskassessment.reaffiliation.isResponsible', function(User $user) {
            // TODO GATE BEFORE Task Allocation
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('riskassessment.download', function(User $user) {
            return true;
        });

        Gate::define('riskassessment.upload', function(User $user) {
            // TODO GATE BEFORE TaskAllocation
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('riskassessmentview', function(User $user) {
            return true;
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
