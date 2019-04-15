<?php

namespace App\Providers;

use App\Authentication\CommitteeRoleProvider;
use App\Authentication\ViewAsStudentProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

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

        // Override gates for super admins
        Gate::before(function(User $user, $ability) {
            // Allow super admins through everything
            if ($user->hasPermissionTo('act-as-super-admin')) {
                return true;
            }


        });

        // Override for Spatie permissions
        Gate::before(function(User $user, $ability) {

            // Override what individuals may do on the site

            // We don't need to check if user is an admin,
            // since then users may own a permission to override their default.
            // Eg: A user may have the 'module.submit' permission to allow them to submit a document even if
            // they shouldn't be able to normally, such as if the pres may not be able to access the portal

            try {
                // Use hasPermissionTo so we don't get stuck in a can loop
                if ($user->hasPermissionTo($ability)) {
                    return true;
                }
            } catch (PermissionDoesNotExist $e) {
                // Let them pass since it may be a user specific position
                // or a pre-migrated position. They won't pass all gates
                // unless they have permission to be here.
            }

            // Don't let admins into the user permissions. They must be seperately given their permissions.
            if ($user->isAdmin()) {
                return false;
            }

        });
    }
}
