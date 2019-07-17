<?php

namespace App\Providers;

use App\Support\Event\Event;
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

        // Give the portal access to all events
        View::composer(['portal.portal'], function ($view) {

            $allEvents = Event::active()->with([
                'moduleInstances',
                'forLogic',
                'adminLogic',
                'moduleInstances.activeLogic',
                'moduleInstances.visibleLogic',
                'moduleInstances.mandatoryLogic',
            ])->get();

            $events = new Collection([
                'participant' => new Collection,
                'administrator' => new Collection
            ]);

            foreach ($allEvents as $event) {
                if (LogicTester::evaluate($event->forLogic)) {
                    $events['participant']->push($event);
                }

                if (LogicTester::evaluate($event->adminLogic)) {
                    $events['administrator']->push($event);
                }
            }
            $view->with('events', $events);

        });

        View::composer(['admin.settings.events.sidebar'], function ($view) {
            $view->with('events', Event::all());
        });

        View::composer(['admin.settings.logic.sidebar'], function ($view) {
            $view->with('logics', Logic::all());
        });

        View::composer(['admin.settings.events.create'], function ($view) {
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
