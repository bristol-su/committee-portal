<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\ModuleInstance\Connection\ModuleInstanceService;
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

        return ModuleInstanceService::create([
            'service' => $request->input('participant_services'),
            '' => $request->input('admin_services')
        ]);
    }

    public function update(ModuleInstanceService $services, Request $request)
    {
        $services->participant_services = $request->input('participant_services', $services->participant_services);
        $services->admin_services = $request->input('admin_services', $services->admin_services);
        $services->save();
        return $services;
    }
}
