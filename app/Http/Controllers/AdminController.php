<?php

namespace App\Http\Controllers;

use App\Modules\BaseModule\ModuleConfiguration;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function showAdminDashboard()
    {
        return view('admin.dashboard');
    }

    public function getStats()
    {

        $configurations = getModuleConfiguration();

        $rawGroups = Group::all();

        return $configurations->map(function($configuration) use ($rawGroups){

            /** @var ModuleConfiguration $config */
            $config = new $configuration['rawModule']->dynamic_configuration;

            return json_decode(Cache::remember('AdminController.getStats.module:'.$config->alias(), mt_rand(60, 2880), function () use ($config, $rawGroups) {
                $groups = $rawGroups->map(function(Group $group) use ($config) {
                    $config->setGroup($group);
                    $completed = $config->isComplete($config->getGroup());
                    $mandatory = ($config->isMandatoryForGroup($group)?true:false);
                    return [
                        'group' => $group->toArray(),
                        'completed' => $completed,
                        'mandatory' => $mandatory
                    ];
                });

                return json_encode([
                    'name' => $config->getButtonTitle(),
                    'alias' => $config->alias(),
                    'groups' => $groups
                ]);
            }));

        });
    }

    public function resetStats(Request $request)
    {
        $this->authorize('reset-stats');
        Cache::forget('AdminController.getStats.module:'.$request->input('module'));
    }

}
