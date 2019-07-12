<?php

namespace App\Providers;

use App\Packages\ControlDB\ControlDB;
use App\Packages\ControlDB\ControlDBInterface;
use App\Packages\UnionCloud\UnionCloud;
use App\Packages\UnionCloud\UnionCloudInterface;
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
