<?php

namespace App\Modules\GroupInfo;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\GroupInfo\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'groupinfo';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Key Group Info';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/groupinfo';
    }

    public function getAdminURL()
    {
        return '/admin/groupinfo';
    }

    public function isComplete(Group $group)
    {
            return Submission::where([
                'year' => getReaffiliationYear(),
                'group_id' => $group->id
            ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This is the group info module';
    }

    public function getAdminHeaderKey()
    {
        return 'group-info';
    }
}