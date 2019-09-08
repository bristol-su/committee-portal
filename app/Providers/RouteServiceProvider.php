<?php

namespace App\Providers;

use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Support\Activity\Activity;
use App\Support\Module\Contracts\ModuleRepository;
use App\Support\Module\Settings\ModuleInstanceSettings;
use App\Support\ModuleInstance\ModuleInstance;
use App\Support\Permissions\Models\ModuleInstancePermissions;
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
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::bind('controlposition', function($id) {
            $position = Position::find($id);
            abort_if(!$position, 404);
            return $position;
        });

        Route::bind('controlgroup', function($id) {
            $group = Group::find($id);
            abort_if(!$group, 404);
            return $group;
        });

        Route::bind('module_instance_setting', function($id) {
            return ModuleInstanceSettings::findOrFail($id);
        });

        Route::bind('module_instance_permission', function($id) {
            return ModuleInstancePermissions::findOrFail($id);
        });

        Route::bind('module', function($alias) {
            return $this->app[ModuleRepository::class]->findByAlias($alias);
        });

        Route::bind('activity_slug', function($slug) {
            return Activity::where(['slug' => $slug])->firstOrFail();
        });

        Route::bind('module_instance_slug', function($slug, $route) {
            $activity = $route->parameter('activity_slug');
            return ModuleInstance::where('slug', $slug)
                ->whereHas('activity', function($query) use ($activity){
                    $query->where('slug', $activity->slug);
                })
                ->firstOrFail();
        });
        parent::boot();
    }

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
