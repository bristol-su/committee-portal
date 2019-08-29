<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Activity\Activity;
use App\Support\Activity\Contracts\Repository;
use App\Support\ModuleInstance\Contracts\ModuleInstanceRepository;
use Illuminate\Http\Request;

class ModuleInstanceController extends Controller
{

    public function store(Request $request, ModuleInstanceRepository $moduleInstanceRepo)
    {
        return $moduleInstanceRepo->create($request->only([
            'alias', 'activity_id', 'name', 'description', 'slug', 'active', 'visible', 'mandatory', 'complete',
            'module_instance_settings_id', 'module_instance_permissions_id'
        ]));
    }

}
