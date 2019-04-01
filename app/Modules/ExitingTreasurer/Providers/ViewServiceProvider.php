<?php

namespace App\Modules\ExitingTreasurer\Providers;

use App\Modules\ExitingTreasurer\Entities\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('exitingtreasurer::exitingtreasurer', function($view) {
            $documents = Document::where([
                'year' => getReaffiliationYear(),
                'group_id' => Auth::user()->getCurrentRole()->group->id
            ])->get();
            return $view->with('documents', $documents);
        });
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
