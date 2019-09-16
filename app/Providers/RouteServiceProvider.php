<?php

namespace App\Providers;

use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Module\Contracts\ModuleRepository;
use BristolSU\Support\ModuleInstance\Settings\ModuleInstanceSettings;
use BristolSU\Support\ModuleInstance\ModuleInstance;
use BristolSU\Support\Permissions\Models\ModuleInstancePermissions;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapPassportRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
    }

    protected function mapPassportRoutes()
    {
        Route::prefix('oauth')
            ->namespace('\Laravel\Passport\Http\Controllers')
            ->group(base_path('routes/passport.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace . '\Api')
                ->group(base_path('routes/api.php'));
    }
}
