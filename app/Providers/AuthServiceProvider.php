<?php

namespace App\Providers;

use App\Authentication\CommitteeRoleProvider;
use App\Authentication\ViewAsStudentProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('committee-role-provider', function($app, array $config) {
            return new CommitteeRoleProvider();
        });

        Auth::provider('view-as-student-provider', function($app, array $config) {
            return new ViewAsStudentProvider();
        });

        // Override gates for admins
        Gate::before(function($user, $ability) {
            // Allow super admins through everything
            if($user->hasPermissionTo('act-as-super-admin')) {
                return true;
            }

            return null;
        });
    }
}
