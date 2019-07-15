<?php

namespace App\Modules\FileUpload\Providers;

use App\Support\Module\ModuleServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FileUploadServiceProvider extends ModuleServiceProvider
{


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mapWebRoutes(__DIR__.'/../Routes/web.php');
        $this->mapApiRoutes(__DIR__.'/../Routes/api.php');
    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('fileupload.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'fileupload'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/fileupload');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function($path) {
            return $path.'/modules/fileupload';
        }, \Config::get('view.paths')), [$sourcePath]), 'fileupload');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/fileupload');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'fileupload');
        } else {
            $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'fileupload');
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
}
