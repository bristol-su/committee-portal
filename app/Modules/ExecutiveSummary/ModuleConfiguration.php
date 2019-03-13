<?php

namespace App\Modules\ExecutiveSummary;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\ExecutiveSummary\Entities\File;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Executive Summary';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/executivesummary';
    }

    public function getAdminURL()
    {
        return '/admin/executivesummary';
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
        if(\Auth::user()->isAdmin()) { return 'admin'; }
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
        return 'This is the executive summary module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }
}