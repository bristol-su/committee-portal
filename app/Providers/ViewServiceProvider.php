<?php

namespace App\Providers;

use App\Http\View\Composers\DashboardComposer;
use App\Http\View\Composers\JavascriptComposer;
use App\Support\Activity\Activity;
use App\Support\Logic\Facade\LogicTester;
use App\Support\Logic\Logic;
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

        View::composer(['portal.portal'], DashboardComposer::class);
        View::composer(['layouts.app'], JavascriptComposer::class);

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
