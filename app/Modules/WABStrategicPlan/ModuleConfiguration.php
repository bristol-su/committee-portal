<?php

namespace App\Modules\WABStrategicPlan;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\WABStrategicPlan\Entities\File;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return '#WeAreBristol Strategic Plan';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/wabstrategicplan';
    }

    public function getAdminURL()
    {
        return '/admin/wabstrategicplan';
    }

    public function getVisibility()
    {
        return true;
    }

    public function isActive()
    {
        return true;
    }

    public function reaffiliationStatus()
    {
        if(Auth::user()->isAdmin()) { return 'admin'; }
        if(File::where([
                'year' => getReaffiliationYear(),
                'status' => 'approved',
                'group_id' => getGroupID()
            ])->count() === 0) {

            return 'incomplete';
        }
        return 'complete';
    }

    public function getDescription()
    {
        return 'This is the #WeAreBristol Strategic Plan module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }

}