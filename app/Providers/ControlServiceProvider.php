<?php


namespace App\Providers;


use App\Support\DataProvider\DataUserModel;
use BristolSU\ControlDB\ControlDBServiceProvider;
use BristolSU\Support\DataPlatform\Contracts\Models\User;

class ControlServiceProvider extends ControlDBServiceProvider
{

    public function register()
    {
        parent::register();
    }

    public function boot()
    {
        parent::boot();
        $this->app->bind(\BristolSU\Support\DataPlatform\Contracts\Repositories\User::class, \App\Support\DataProvider\Repositories\User::class);

    }

}
