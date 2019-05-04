<?php

namespace App\Modules\ExecutiveSummary;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\ExecutiveSummary\Entities\File;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

    public function alias()
    {
        return 'executivesummary';
    }

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Executive Summary';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return false;
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

    public function isComplete(Group $group)
    {
        return File::where([
            'year' => getReaffiliationYear(),
            'status' => 'approved',
            'group_id' => $group->id
        ])->count() > 0;
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