<?php


namespace App\Support\Module\ModuleInstance;


use App\Support\Module\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\Module\Contracts\ModuleInstanceRepository as ModuleInstanceRepositoryContract;

class ModuleInstanceRepository implements ModuleInstanceRepositoryContract
{

    public function getById(int $id): ModuleInstanceContract
    {
        return ModuleInstance::findOrFail($id);
    }

    public function create($alias, $eventId, $name, $description, $active, $visible, $mandatory, $complete) : ModuleInstanceContract
    {
        return ModuleInstance::create([
            'alias' => $alias,
            'event_id' => $eventId,
            'name' => $name,
            'description' => $description,
            'active' => $active,
            'visible' => $visible,
            'mandatory' => $mandatory,
            'complete' => $complete
        ]);
    }

}