<?php

namespace App\Modules\Budget\Providers;

use App\Modules\Budget\Entities\File;
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

        Gate::define('budget.view', function(User $user) {
            return true;
        });

        Gate::define('budget.download', function(User $user, File $file) {
            return $file->group_id === $user->getCurrentRole()->group->id && $user->can('budget.module.isVisible');
        });

        // Who can upload a budget
        Gate::define('budget.upload', function(User $user) {
           $this->studentHasTreasurerPosition($user)
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
