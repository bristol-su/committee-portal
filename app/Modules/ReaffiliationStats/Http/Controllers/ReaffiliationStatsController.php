<?php

namespace App\Modules\ReaffiliationStats\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\BaseModule\ModuleConfiguration;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReaffiliationStatsController extends Controller
{
    public function showAdminPage()
    {
        $this->authorize('reaffiliationstats.view-admin');

        $modules = getModuleConfiguration();
        $modules = $modules->map(function($configuration) {
            // Add string index to array
            $index = $configuration['header'];
            $configuration['header'] = config('portal.headers.'.$index);
            $configuration['header']['index'] = $index;

            // Load information from gates
            foreach(config('portal.header_information_gates') as $key => $information) {
                $configuration[$key] = Auth::user()->can($configuration['alias'].'.'.$information);
            }
            return $configuration;
        });

        return view('reaffiliationstats::reaffiliationstats_admin')->with(compact($modules));
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
}
