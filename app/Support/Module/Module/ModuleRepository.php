<?php


namespace App\Support\Module\Module;


use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use Illuminate\Support\Collection;
use Nwidart\Modules\Facades\Module;

class ModuleRepository implements ModuleRepositoryContract
{

    public function all()
    {
        $moduleJson = new Collection;
        $modules = Module::all();
        foreach($modules as $module) {
            $moduleJson->push($module->json());
        }
        return $moduleJson;
    }

}