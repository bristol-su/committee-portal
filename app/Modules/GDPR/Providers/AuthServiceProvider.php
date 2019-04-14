<?php


namespace App\Modules\GDPR\Providers;


use App\Traits\AuthorizesUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use AuthorizesUsers;

    protected $defer = false;

    public function register() {


        Gate::define('gdpr.module.isVisible', function(User $user) {
            return true;
        });

        Gate::define('gdpr.module.isActive', function(User $user) {
            return true;
        });

        Gate::define('gdpr.reaffiliation.isMandatory', function(User $user) {
            return true;
        });

        Gate::define('gdpr.reaffiliation.isResponsible', function(User $user) {
            return $this->studentHasPresidentialPosition($user) && $this->studentIsNewCommittee($user);
        });

        Gate::define('gdpr.view', function(User $user) {
            return true;
        });

    }
}