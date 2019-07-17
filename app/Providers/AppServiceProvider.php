<?php

namespace App\Providers;

use App\Packages\ControlDB\ControlDB;
use App\Packages\ControlDB\ControlDBInterface;
use App\Packages\UnionCloud\UnionCloud;
use App\Packages\UnionCloud\UnionCloudInterface;
use App\Support\Control\Models\Contracts\Group as GroupModelContract;
use App\Support\Control\Models\Contracts\GroupTag as GroupTagModelContract;
use App\Support\Control\Models\Contracts\Role as RoleModelContract;
use App\Support\Control\Models\Group as GroupModel;
use App\Support\Control\Models\GroupTag as GroupTagModel;
use App\Support\Control\Models\Role as RoleModel;
use App\Support\Control\Repositories\Contracts\Group as GroupRepositoryContract;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepositoryContract;
use App\Support\Control\Repositories\Contracts\Role as RoleRepositoryContract;
use App\Support\Control\Repositories\Group as GroupRepository;
use App\Support\Control\Repositories\GroupTag as GroupTagRepository;
use App\Support\Control\Repositories\Role as RoleRepository;
use App\Support\Logic\AuthenticationModelFactory;
use App\Support\Logic\Contracts\AuthenticationModelFactory as AuthenticationModelFactoryContract;
use App\Support\Logic\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Logic\Contracts\LogicTester as LogicTesterContract;
use App\Support\Logic\FilterFactory;
use App\Support\Logic\LogicTester;
use App\Support\Module\Contracts\ModuleInstanceRepository as ModuleInstanceRepositoryContract;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use App\Support\Module\Module\ModuleRepository;
use App\Support\Module\ModuleInstance\ModuleInstanceRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ControlDBInterface::class, ControlDB::class);
        $this->app->bind(UnionCloudInterface::class, UnionCloud::class);
        $this->app->bind(ModuleRepositoryContract::class, ModuleRepository::class);
        $this->app->bind(ModuleInstanceRepositoryContract::class, ModuleInstanceRepository::class);
        $this->app->bind(LogicTesterContract::class, LogicTester::class);
        $this->app->bind(FilterFactoryContract::class, FilterFactory::class);
        $this->app->bind(AuthenticationModelFactoryContract::class, AuthenticationModelFactory::class);

        $this->app->bind(GroupTagModelContract::class, GroupTagModel::class);
        $this->app->bind(GroupModelContract::class, GroupModel::class);
        $this->app->bind(RoleModelContract::class, RoleModel::class);

        $this->app->bind(GroupTagRepositoryContract::class, GroupTagRepository::class);
        $this->app->bind(GroupRepositoryContract::class, GroupRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
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
