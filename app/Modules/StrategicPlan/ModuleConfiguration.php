<?php

namespace App\Modules\StrategicPlan;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\StrategicPlan\Entities\File;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'strategicplan';
}

    public function getButtonTitle()
    {
        return 'Strategic Plan';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/strategicplan';
    }

    public function getAdminURL()
    {
        return '/admin/strategicplan';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return false;
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
        return 'This is the strategic plan module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }

}