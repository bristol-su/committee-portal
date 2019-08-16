<?php

namespace App\Support\Completion;

use App\Support\Completion\Contracts\StoreEvent;
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
            'activity_id' => $event->moduleInstance()->activity->id,
            'event' => get_class($event),
            'keywords' => $event->keywords(),
            'user_id' => $event->userId(),
            'group_id' => $event->groupId(),
            'role_id' => $event->roleId()
        ]);
    }

}
