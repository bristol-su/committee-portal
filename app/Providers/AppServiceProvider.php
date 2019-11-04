<?php

namespace App\Providers;



use App\Support\User\User;
use BristolSU\Support\Permissions\Contracts\PermissionTester;
use BristolSU\Support\Permissions\Facade\PermissionTester as PermissionTesterFacade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::withoutCookieSerialization();



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
