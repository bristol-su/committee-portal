<?php

namespace App\Modules\EquipmentList;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\EquipmentList\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function alias()
    {
        return 'equipmentlist';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getButtonTitle()
    {
        return 'Equipment List';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/equipmentlist';
    }

    public function getAdminURL()
    {
        return '/admin/equipmentlist';
    }

    public function isComplete(Group $group)
    {
        return Submission::where([
            'group_id' => $group->id,
            'year' => getReaffiliationYear()
        ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This page allows you to track the equipment that [student group name] owns. It also allows Bristol SU to log any items with a value of over £500 for auditing purposes.';
    }

    public function getAdminHeaderKey()
    {
        return 'assets';
    }
}