<?php

namespace App\Modules\GroupInfo\Providers;


use App\Modules\GroupInfo\Events\GroupInformationUpdated;
use App\Modules\GroupInfo\Listeners\LogGroupDataSubmission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
   protected $listen = [
       GroupInformationUpdated::class => [
           LogGroupDataSubmission::class
       ]
   ];
}
