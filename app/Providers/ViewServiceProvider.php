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
        View::composer('portal', function($view) {
            $configuration = $this->getModuleConfigurations();
            $view->with('modules', $configuration);
        });

        // Allow student groups to appear on the header
        View::composer('templates.groupselect', function($view) {
            $student = Student::find(Auth::user()->control_id);
            $committeeRoles = CommitteeRole::allThrough($student);
            $view->with('_committeeRoles', $committeeRoles);
        });
    }

    private function getModuleConfigurations()
    {
        $rawModules = collect(Module::getOrdered())->filter(function($module) {
            return $module->active === 1;
        });
        $configuration = new Collection();
        foreach($rawModules as $rawModule)
        {
            if( !class_exists($rawModule->dynamic_configuration)) {
                throw new \Exception('Please define a dynamic_configuration property in module '.$rawModule->getName());
            }

            $moduleConfig = (new $rawModule->dynamic_configuration)->getConfiguration();
            $moduleConfig['rawModule'] = $rawModule;
            $configuration->push($moduleConfig);
        }
        return $configuration;
    }

}
