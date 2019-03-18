<?php

namespace App\Modules\ExecutiveSummary;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\ExecutiveSummary\Entities\File;
use Illuminate\Support\Facades\Auth;

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

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }

        if (File::where([
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