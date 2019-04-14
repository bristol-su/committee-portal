<?php

namespace App\Modules\TierSelection\Providers;

use App\Modules\TierSelection\Entities\Submission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TierSelectionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        // Default the tier submission year to the current reaffiliation year.
        Submission::creating(function($submission) {
            $submission->year = config('portal.reaffiliation_year');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('tierselection.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'tierselection'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/tierselection');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function($path) {
            return $path.'/modules/tierselection';
        }, \Config::get('view.paths')), [$sourcePath]), 'tierselection');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/tierselection');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tierselection');
        } else {
            $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'tierselection');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load(__DIR__.'/../Database/factories');
        }
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
