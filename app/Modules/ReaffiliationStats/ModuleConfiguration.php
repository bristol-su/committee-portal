<?php

namespace App\Modules\ReaffiliationStats;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\RiskAssessment\Entities\File;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'reaffiliationstats';
}

    protected $mandatoryForReaffiliation = false;

    public function getButtonTitle()
    {
        return 'Reaffiliation Progress';
    }

    public function getHeaderKey()
    {
        return 'stats';
    }

    public function getUserURL()
    {
        return '/';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return false;
    }

    public function getAdminURL()
    {
        return '/admin/reaffiliation-stats';
    }

    public function isComplete(Group $group)
    {
        return false;
    }

    public function getDescription()
    {
        return 'This page shows statistics about group completion rate of reaffiliation';
    }

    public function getAdminHeaderKey()
    {
        return 'stats';
    }

}