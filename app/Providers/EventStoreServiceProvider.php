<?php


namespace App\Providers;


use App\Support\EventStore\Contracts\EventStoreRepository as EventStoreRepositoryContract;
use App\Support\EventStore\EventStoreRepository;
use Illuminate\Support\ServiceProvider;

class EventStoreServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(EventStoreRepositoryContract::class, EventStoreRepository::class);
    }

    public function boot()
    {

    }


}
