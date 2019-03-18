<?php

namespace App\Providers;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootViewComposers();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootViewComposers()
    {

        // Give the portal access to all modules
        View::composer(['portal', 'dashboard'], function($view) {
            $configuration = getModuleConfiguration();
            $view->with('modules', $configuration);
        });


    }

}
