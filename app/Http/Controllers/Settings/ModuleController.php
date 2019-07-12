<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use App\Support\Module\Module\Module;

class ModuleController extends Controller
{
    /**
     * @var ModuleRepositoryContract
     */
    private $moduleRepository;

    public function __construct(ModuleRepositoryContract $moduleRepository)
    {

        $this->moduleRepository = $moduleRepository;
    }

    public function index()
    {
        $modules = collect($this->moduleRepository->all());

        // TODO Clean up

        $modules = $modules->map(function(Module $module) {
            $module->completion = config($module->alias().'.completion');
            return $module;
        });
        return $modules;
    }

    public function settings(Module $module)
    {
        return config($module->alias().'.settings');
        // get settings from alias
    }

    public function permissions(Module $module)
    {
        return config($module->alias().'.permissions');
        // get settings from alias
    }

}
