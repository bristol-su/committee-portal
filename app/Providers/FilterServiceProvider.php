<?php

namespace App\Providers;

use App\Support\Filters\ConfigFilterRepository;
use App\Support\Filters\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Filters\Contracts\FilterInstance as FilterInstanceContract;
use App\Support\Filters\Contracts\FilterInstanceRepository as FilterInstanceRepositoryContract;
use App\Support\Filters\Contracts\FilterRepository as FilterRepositoryContract;
use App\Support\Filters\Contracts\FilterTester as FilterTesterContract;
use App\Support\Filters\FilterInstance;
use App\Support\Filters\FilterInstanceRepository;
use App\Support\Filters\FilterTester;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FilterRepositoryContract::class, ConfigFilterRepository::class);
        $this->app->bind(FilterFactoryContract::class, \App\Support\Filters\FilterFactory::class);
        $this->app->bind(FilterTesterContract::class, FilterTester::class);

        $this->app->bind(FilterInstanceContract::class, FilterInstance::class);
        $this->app->bind(FilterInstanceRepositoryContract::class, FilterInstanceRepository::class);
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
