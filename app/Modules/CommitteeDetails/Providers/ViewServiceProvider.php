<?php

namespace App\Modules\CommitteeDetails\Providers;

use App\Packages\ControlDB\ControlDBInterface;
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

    public function boot(ControlDBInterface $controlDB)
    {
        View::composer('committeedetails::details_submission', function($view) use ($controlDB) {
            $committee = \App\Modules\CommitteeDetails\Entities\Committee::where(['year' => getReaffiliationYear(), 'group_control_id' => Auth::user()->getCurrentPosition()['group_id']])->get();
            foreach(array_diff(config('control.executive_committee_positions'), $committee->pluck('id')->toArray()) as $position)
            {
                $committee[] = [
                    'position_id' => $position,
                    'position_name' => $controlDB->getSpecificPosition($position)->name
                ];
            }

            $view->with('committee', $committee);

        });
    }
}
