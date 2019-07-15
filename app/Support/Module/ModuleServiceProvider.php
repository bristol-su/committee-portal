<?php


namespace App\Support\Module;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $namespace = 'App\Http\Controllers';

    public function mapWebRoutes($path)
    {
        Route::prefix('{event_slug}/{module_instance_slug}')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/web.php');
    }

    public function mapApiRoutes($path)
    {
        Route::prefix('{event_slug}/{module_instance_slug}')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }
}