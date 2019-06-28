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

        // Give the portal access to all modules
        View::composer(['portal', 'dashboard'], function($view) {
            $configurations = getModuleConfiguration();
            $configurations = $configurations->map(function($configuration) {
                // Add string index to array
                $index = $configuration['header'];
                $configuration['header'] = config('portal.headers.'.$index);
                $configuration['header']['index'] = $index;

                // Load information from gates
                foreach(config('portal.header_information_gates') as $key => $information) {
                    $configuration[$key] = Auth::user()->can($configuration['alias'].'.'.$information);
                }
                return $configuration;
            });

            $view->with('modules', $configurations);
        });

        View::composer(['admin.settings.events.sidebar'], function($view) {
            $view->with('events', Event::all());
        });

        View::composer(['admin.settings.events.create'], function($view) {
            $view->with([
                'groupLogic' => Logic::groups()->get(),
                'studentLogic' => Logic::students()->get()
            ]);
        });
    }

}
