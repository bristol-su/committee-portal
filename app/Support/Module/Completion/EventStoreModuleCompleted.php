<?php


namespace App\Support\Module\Completion;


use App\Support\Module\Contracts\ModuleCompleted as ModuleCompletedContract;
use App\Support\Module\Contracts\ModuleInstance;

class EventStoreModuleCompleted implements ModuleCompletedContract
{

    public function complete(ModuleInstance $moduleInstance): bool
    {
        // TODO: Implement complete() method.
    }

}