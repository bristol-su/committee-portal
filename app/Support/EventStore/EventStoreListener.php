<?php

namespace App\Support\EventStore;

use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class EventStoreListener implements ShouldQueue
{

    public function __construct()
    {

    }

    public function handle(StoreEvent $event)
    {
        EventStore::create([
            'module_instance_id' => $event->moduleInstance()->id,
            'event_id' => $event->moduleInstance()->event->id,
            'event' => get_class($event),
            'keywords' => $event->keywords(),
            'user_id' => $event->userId(),
            'group_id' => $event->groupId(),
            'role_id' => $event->roleId()
        ]);
    }

}