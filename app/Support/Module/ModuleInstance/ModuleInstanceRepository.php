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

    public function create(array $attributes) : ModuleInstanceContract
    {
        return ModuleInstance::create($attributes);
    }

}