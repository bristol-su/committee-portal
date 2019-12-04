<?php

namespace App\Providers;

use App\Http\View\Header\CurrentAuthComposer;
use App\Http\View\Portal\ActivitySidebarComposer;
use App\Http\View\Utilities\JavascriptComposer;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Logic\Facade\LogicTester;
use BristolSU\Support\Logic\Logic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

    private function bootViewComposers()
    {
        // TODO Replace with repositories

        View::composer(['portal.activity'], ActivitySidebarComposer::class);
        View::composer(['bristolsu::base'], JavascriptComposer::class);
        View::composer(['partials.header'], CurrentAuthComposer::class);

        View::composer(['admin.settings.activities.sidebar'], function ($view) {
            $view->with('events', Activity::all());
        });

        View::composer(['admin.settings.logic.sidebar'], function ($view) {
            $view->with('logics', Logic::all());
        });

        View::composer(['admin.settings.activities.create'], function ($view) {
            $view->with([
                'groupLogic' => Logic::groups()->get(),
                'studentLogic' => Logic::students()->get()
            ]);
        });

        View::composer(['admin.settings.logic.create'], function ($view) {
            $filterClasses = config('app.filters');
            $filters = [];
            foreach ($filterClasses as $id => $filterClass) {
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

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
