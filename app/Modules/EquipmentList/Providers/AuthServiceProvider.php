<?php

namespace App\Modules\EquipmentList\Providers;

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
        Gate::define('equipmentlist.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('equipmentlist.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('equipmentlist.reaffiliation.isMandatory', function(User $user) {
            return true;
        });

        Gate::define('equipmentlist.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user) && $this->studentIsNewCommittee($user);
        });

        Gate::define('equipmentlist.view', function(User $user) {
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
