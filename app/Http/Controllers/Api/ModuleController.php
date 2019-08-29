<?php


namespace App\Http\Controllers\Api;


use App\Support\Filters\Contracts\Filters\Filter;
use App\Support\Module\Contracts\ModuleRepository;
use App\Support\Module\Module;

class ModuleController
{

    public function index(ModuleRepository $moduleRepository)
    {
        return collect($moduleRepository->all())->map(function(Module $module) {
            return $module->toArray();
        });

    }

}
