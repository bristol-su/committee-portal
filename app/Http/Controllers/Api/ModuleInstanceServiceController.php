<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\ModuleInstance\Connection\ModuleInstanceService;
use BristolSU\Support\ModuleInstance\Contracts\Connection\ModuleInstanceServiceRepository;
use Illuminate\Http\Request;

class ModuleInstanceServiceController extends Controller
{

    public function show(ModuleInstanceService $moduleInstanceServices)
    {
        return $moduleInstanceServices;
    }

    public function store(Request $request)
    {
        $moduleInstanceService = new ModuleInstanceService(['service' => $request->input('service')]);
        $moduleInstanceService->connection_id = $request->input('connection_id');
        $moduleInstanceService->module_instance_id = $request->input('module_instance_id');

        $moduleInstanceService->save();

        return $moduleInstanceService;
    }

    public function update(ModuleInstanceService $service, Request $request)
    {
        $service->connection_id = $request->input('connection_id', $service->connection_id);

        $service->save();

        return $service;
    }

    public function index(ModuleInstanceServiceRepository $repository)
    {
        return $repository->all();
    }
}
