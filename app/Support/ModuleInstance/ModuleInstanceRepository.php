<?php


namespace App\Support\ModuleInstance;


use App\Support\ModuleInstance\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\ModuleInstance\Contracts\ModuleInstanceRepository as ModuleInstanceRepositoryContract;

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
