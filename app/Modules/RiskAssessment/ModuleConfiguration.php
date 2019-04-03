<?php

namespace App\Modules\RiskAssessment;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\RiskAssessment\Entities\File;

class ModuleConfiguration extends BaseModuleConfiguration
{

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

    public function getAdminURL()
    {
        return '/admin/riskassessment';
    }

    public function isComplete()
    {
    return File::where([
            'year' => getReaffiliationYear(),
            'status' => 'approved',
            'group_id' => getGroupID()
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