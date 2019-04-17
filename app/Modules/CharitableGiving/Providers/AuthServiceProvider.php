<?php


namespace App\Modules\CharitableGiving\Providers;

use App\Traits\AuthorizesUsers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    use AuthorizesUsers;

    protected $defer = false;

    public function register()
    {
        Gate::define('charitablegiving.module.isVisible', function (User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'charitable_giving_awareness');
        });

        Gate::define('charitablegiving.module.isActive', function (User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'charitable_giving_awareness');
        });

        Gate::define('charitablegiving.reaffiliation.isMandatory', function (User $user) {
            return $this->groupHasTag($user, 'reaffiliation_tasks', 'charitable_giving_awareness');
        });

        Gate::define('charitablegiving.reaffiliation.isResponsible', function (User $user) {
            return $this->studentHasPresidentialPosition($user) && $this->studentIsNewCommittee($user);
        });

        Gate::define('charitablegiving.view', function (User $user) {
            return true;
        });

        Gate::define('charitablegiving.submit', function(User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });
    }

}