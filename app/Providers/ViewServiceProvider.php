<?php

namespace App\Providers;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use App\Support\Event\Event;
use App\Support\Logic\Logic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        // Give the portal access to all events
        View::composer(['portal.portal', 'dashboard'], function($view) {
            $events = Event::active()->get();
            $events->load('moduleInstances');
            // TODO Test logic
            $view->with('events', $events);
//            $configurations = getModuleConfiguration();
//            $configurations = $configurations->map(function($configuration) {
//                // Add string index to array
//                $index = $configuration['header'];
//                $configuration['header'] = config('portal.headers.'.$index);
//                $configuration['header']['index'] = $index;
//
//                // Load information from gates
//                foreach(config('portal.header_information_gates') as $key => $information) {
//                    $configuration[$key] = Auth::user()->can($configuration['alias'].'.'.$information);
//                }
//                return $configuration;
//            });
//
//            $view->with('modules', $configurations);
        });

//        View::composer(['portal.portal', 'dashboard'], function($view) {
//            $configurations = getModuleConfiguration();
//            $configurations = $configurations->map(function($configuration) {
//                // Add string index to array
//                $index = $configuration['header'];
//                $configuration['header'] = config('portal.headers.'.$index);
//                $configuration['header']['index'] = $index;
//
//                // Load information from gates
//                foreach(config('portal.header_information_gates') as $key => $information) {
//                    $configuration[$key] = Auth::user()->can($configuration['alias'].'.'.$information);
//                }
//                return $configuration;
//            });
//
//            $view->with('modules', $configurations);
//        });

        View::composer(['admin.settings.events.sidebar'], function($view) {
            $view->with('events', Event::all());
        });

        View::composer(['admin.settings.logic.sidebar'], function($view) {
            $view->with('logics', Logic::all());
        });

        View::composer(['admin.settings.events.create'], function($view) {
            $view->with([
                'groupLogic' => Logic::groups()->get(),
                'studentLogic' => Logic::students()->get()
            ]);
        });

        View::composer(['admin.settings.logic.create'], function($view) {
            $filterClasses = config('app.filters');
            $filters = [];
            foreach($filterClasses as $id=>$filterClass) {
                $instanciated = resolve($filterClass);
                $filters[] = [
                    'id' => $id,
                    'name' => $filterClass::name(),
                    'description' => $filterClass::description(),
                    'validFor' => $instanciated->validFor(),
                    'options' => $instanciated->options()
                ];
            }
            $view->with('filters', $filters);
        });
    }

}
