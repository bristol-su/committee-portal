<?php

namespace App\Providers;

use App\Support\Filters\ConfigFilterRepository;
use App\Support\Filters\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Filters\Contracts\FilterInstance as FilterInstanceContract;
use App\Support\Filters\Contracts\FilterRepository as FilterRepositoryContract;
use App\Support\Filters\Contracts\FilterTester as FilterTesterContract;
use App\Support\Filters\FilterInstance;
use App\Support\Filters\FilterTester;
use App\Support\Logic\Contracts\LogicRepository as LogicRepositoryContract;
use App\Support\Logic\LogicRepository;
use Illuminate\Support\ServiceProvider;

class LogicServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LogicRepositoryContract::class, LogicRepository::class);
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
