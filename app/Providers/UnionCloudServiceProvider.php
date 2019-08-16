<?php


namespace App\Providers;


use App\Support\DataPlatform\Contracts\Repositories\User as UserRepositoryContract;
use App\Support\DataPlatform\Repositories\User as UserRepository;
use Illuminate\Support\ServiceProvider;

class UnionCloudServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    public function boot()
    {

    }

}
