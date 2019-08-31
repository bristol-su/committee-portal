<?php

namespace App\Support\EventStore;

use App\Support\EventStore\Contracts\EventStoreRepository;
use App\Support\EventStore\Contracts\StorableEvent;
use App\Support\ModuleInstance\Contracts\ModuleInstanceRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class EventStoreListener implements ShouldQueue
{


    /**
     * @var ModuleInstanceRepository
     */
    private $moduleInstanceRepository;
    /**
     * @var EventStoreRepository
     */
    private $eventStoreRepository;

    public function __construct(ModuleInstanceRepository $moduleInstanceRepository, EventStoreRepository $eventStoreRepository)
    {
        $this->moduleInstanceRepository = $moduleInstanceRepository;
        $this->eventStoreRepository = $eventStoreRepository;
    }

    public function handle(StorableEvent $event)
    {
        $moduleInstance = $this->moduleInstanceRepository->getById($event->moduleInstanceId());
        $this->eventStoreRepository->create([
            'module_instance_id' => $event->moduleInstanceId(),
            'keywords' => $event->keywords(),
            'user_id' => $event->userId(),
            'group_id' => $event->groupId(),
            'role_id' => $event->roleId(),
            'event' => get_class($event)
        ]);
    }

}
