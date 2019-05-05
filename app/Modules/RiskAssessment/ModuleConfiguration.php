<?php

namespace App\Modules\RiskAssessment;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\RiskAssessment\Entities\File;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'riskassessment';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Risk Assessment';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/riskassessment';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getAdminURL()
    {
        return '/admin/riskassessment';
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
        return 'This is the risk assessment module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }

}