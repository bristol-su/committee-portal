<?php

namespace App\Providers;

use App\Support\Control\Models\Contracts\Group as GroupContract;
use Illuminate\Support\ServiceProvider;

class ControlDatabaseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // TODO Register all control repositories to instanciations
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
