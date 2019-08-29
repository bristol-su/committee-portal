<?php

namespace App\Providers;

use App\Support\Control\Client\GuzzleClient;
use App\Support\Control\Client\Token;
use App\Support\Control\Contracts\Client\Client as ClientContract;
use App\Support\Control\Contracts\Client\Token as TokenContract;
use App\Support\Control\Contracts\Models\Group as GroupModelContract;
use App\Support\Control\Contracts\Models\GroupTag as GroupTagModelContract;
use App\Support\Control\Contracts\Models\Role as RoleModelContract;
use App\Support\Control\Contracts\Models\User as UserContract;

use App\Support\Control\Models\Group as GroupModel;
use App\Support\Control\Models\GroupTag as GroupTagModel;
use App\Support\Control\Models\Role as RoleModel;
use App\Support\Control\Models\User as UserModel;


use App\Support\Control\Contracts\Repositories\Group as GroupRepositoryContract;
use App\Support\Control\Contracts\Repositories\GroupTag as GroupTagRepositoryContract;
use App\Support\Control\Contracts\Repositories\Role as RoleRepositoryContract;
use App\Support\Control\Contracts\Repositories\User as UserRepositoryContract;
use App\Support\Control\Repositories\Group as GroupRepository;
use App\Support\Control\Repositories\GroupTag as GroupTagRepository;
use App\Support\Control\Repositories\Role as RoleRepository;
use App\Support\Control\Repositories\User as UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ControlClientServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Client
        $this->app->singleton(ClientContract::class, GuzzleClient::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [
            ClientContract::class,
        ];
    }

}
