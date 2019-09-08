<?php


namespace App\Providers;


use App\Support\Permissions\Contracts\Models\Permission as PermissionContract;
use App\Support\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use App\Support\Permissions\Contracts\PermissionStore as PermissionStoreContract;
use App\Support\Permissions\Contracts\PermissionTester as PermissionTesterContract;
use App\Support\Permissions\Facade\Permission as PermissionFacade;
use App\Support\Permissions\Facade\PermissionTester as PermissionTesterFacade;
use App\Support\Permissions\Models\ModuleInstancePermissions;
use App\Support\Permissions\Models\Permission;
use App\Support\Permissions\PermissionRepository;
use App\Support\Permissions\PermissionStore;
use App\Support\Permissions\PermissionTester;
use App\Support\Permissions\Testers\SystemUserPermission;
use App\User;
use Arcanedev\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PermissionContract::class, Permission::class);
        $this->app->singleton(PermissionStoreContract::class, PermissionStore::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);

        $this->app->bind(PermissionTesterContract::class, PermissionTester::class);
    }

    public function boot()
    {
        foreach(config('permissions.testers') as $tester) {
            PermissionTesterFacade::register($this->app->make($tester));
        }
        PermissionFacade::registerSitePermission(
            'settings',
            'Access Settings',
            'Can access the settings page'
        );

        Gate::before(function(User $user, $ability) {
            return PermissionTesterFacade::evaluate($ability);
        });

    }
}
