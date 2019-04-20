<?php

namespace App\Modules\ExternalAccounts\Providers;

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
        Gate::define('externalaccounts.module.isVisible', function(User $user) {
            return $this->groupHasTag($user, 'bank', 'external_account');
        });

        Gate::define('externalaccounts.module.isActive', function(User $user) {
            return $this->groupHasTag($user, 'bank', 'external_account');
        });

        Gate::define('externalaccounts.reaffiliation.isMandatory', function(User $user) {
            return $this->groupHasTag($user, 'bank', 'external_account');
        });

        Gate::define('externalaccounts.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.view', function(User $user) {
            return true;
        });

        Gate::define('externalaccounts.account.create', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.closure.create', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.eoy.create', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.submission.create', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.statement.create', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.account.get', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.closure.get', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.eoy.get', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.submission.get', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
        });

        Gate::define('externalaccounts.statement.get', function(User $user) {
            return $this->studentHasTreasurerPosition($user) && $this->studentIsOldCommittee($user);
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