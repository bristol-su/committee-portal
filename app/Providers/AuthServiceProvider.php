<?php

namespace App\Providers;

use BristolSU\Support\Permissions\Models\SitewidePermission;
use BristolSU\Support\Permissions\Models\StaticPermissionOverride;
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


    }
}
