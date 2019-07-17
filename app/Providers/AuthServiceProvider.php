<?php

namespace App\Providers;

use App\Authentication\RoleProvider;
use App\Authentication\GroupProvider;
use App\Support\Authentication\LaravelAuthentication;
use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Repositories\Contracts\Group as GroupRepositoryContract;
use App\Support\Control\Repositories\Contracts\Role as RoleRepositoryContract;
use App\Support\Module\Module\Permissions\ModuleInstancePermissions;
use App\Support\Module\Permissions\SitewidePermission;
use App\Support\Module\Permissions\StaticPermissionOverride;
use App\User;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

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

        Gate::before(function(User $user, $ability) {
            return StaticPermissionOverride::passes($user, $ability);
        });

        Gate::before(function(User $user, $ability) {
            return SitewidePermission::passes($user, $ability);
        });

        Gate::before(function(User $user, $ability) {
            return ModuleInstancePermissions::passes($user, $ability);
        });

    }
}
