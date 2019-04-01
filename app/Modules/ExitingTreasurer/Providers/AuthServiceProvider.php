<?php

namespace App\Modules\ExitingTreasurer\Providers;

use App\Modules\ExitingTreasurer\Entities\TreasurerSignOffDocument;
use App\Modules\ExitingTreasurer\Policies\TreasurerSignOffDocumentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
