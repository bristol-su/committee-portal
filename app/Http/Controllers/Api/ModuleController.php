<?php


namespace App\Http\Controllers\Api;


use BristolSU\Support\Filters\Contracts\Filters\Filter;
use BristolSU\Support\Module\Contracts\ModuleRepository;
use BristolSU\Support\Module\Module;

class ModuleController
{

    public function index(ModuleRepository $moduleRepository)
    {
        return collect($moduleRepository->all())->map(function(Module $module) {
            return $module->toArray();
        });

    }

    public function show(Module $module)
    {
        return $module;
    }

}
