<?php

namespace App\Providers;

use App\Support\Control\Models\Contracts\Group as GroupModelContract;
use App\Support\Control\Models\Contracts\GroupTag as GroupTagModelContract;
use App\Support\Control\Models\Contracts\Role as RoleModelContract;
use App\Support\Control\Models\Contracts\User as UserContract;

use App\Support\Control\Models\Group as GroupModel;
use App\Support\Control\Models\GroupTag as GroupTagModel;
use App\Support\Control\Models\Role as RoleModel;
use App\Support\Control\Models\User as UserModel;


use App\Support\Control\Repositories\Contracts\Group as GroupRepositoryContract;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepositoryContract;
use App\Support\Control\Repositories\Contracts\Role as RoleRepositoryContract;
use App\Support\Control\Repositories\Contracts\User as UserRepositoryContract;
use App\Support\Control\Repositories\Group as GroupRepository;
use App\Support\Control\Repositories\GroupTag as GroupTagRepository;
use App\Support\Control\Repositories\Role as RoleRepository;
use App\Support\Control\Repositories\User as UserRepository;
use Illuminate\Support\ServiceProvider;

class ControlProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Models
        $this->app->bind(GroupTagModelContract::class, GroupTagModel::class);
        $this->app->bind(GroupModelContract::class, GroupModel::class);
        $this->app->bind(RoleModelContract::class, RoleModel::class);
        $this->app->bind(UserContract::class, UserModel::class);

        // Repositories
        $this->app->bind(GroupRepositoryContract::class, GroupRepository::class);
        $this->app->bind(GroupTagRepositoryContract::class, GroupTagRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
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
}
