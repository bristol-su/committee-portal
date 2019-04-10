<?php


namespace App\Modules\EquipmentList\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // TODO Event::listen('equipmentlist.submitted', function() {});
    }

}