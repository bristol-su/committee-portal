<?php

namespace App\Providers;

use App\Support\Authentication\AuthenticationProvider\GroupProvider;
use App\Support\Authentication\AuthenticationProvider\RoleProvider;
use App\Support\Authentication\LaravelAuthentication;
use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Contracts\Repositories\Group as GroupRepositoryContract;
use App\Support\Control\Contracts\Repositories\Role as RoleRepositoryContract;
use App\Support\Permissions\Models\ModuleInstancePermissions;
use App\Support\Permissions\Models\SitewidePermission;
use App\Support\Permissions\Models\StaticPermissionOverride;
use App\User;
use Illuminate\Contracts\Container\Container;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('role-provider', function(Container $app, array $config) {
            return new RoleProvider($app->make(RoleRepositoryContract::class));
        });

        Auth::provider('group-provider', function(Container $app, array $config) {
            return new GroupProvider($app->make(GroupRepositoryContract::class));
        });


        $this->app->bind(AuthenticationContract::class, LaravelAuthentication::class);
    }
}
