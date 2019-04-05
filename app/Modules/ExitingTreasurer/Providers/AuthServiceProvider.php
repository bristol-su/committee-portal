<?php

namespace App\Modules\ExitingTreasurer\Providers;

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
        Gate::define('exitingtreasurer.module.isVisible', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.module.isActive', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.reaffiliation.isMandatory', function (User $user) {
            return !$this->groupHasTag($user, 'group_type', 'volunteering');
        });

        Gate::define('exitingtreasurer.reaffiliation.isResponsible', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.view', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.view-upload-documents', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.create-expenseclaim', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.get-expenseclaim', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.delete-expenseclaim', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.create-invoice', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.get-invoice', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.delete-invoice', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.create-missing-i-and-e', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.get-missing-i-and-e', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.delete-missing-i-and-e', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.create-correction', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.get-correction', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.delete-correction', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.approve', function (User $user) {
            return $this->studentHasTreasurerPosition($user)
                && !$this->studentIsNewCommittee($user);
        });

        Gate::define('exitingtreasurer.see-submissions', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.download-treasurer-document', function (User $user) {
            return true;
        });

        Gate::define('exitingtreasurer.download-report', function (User $user) {
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
