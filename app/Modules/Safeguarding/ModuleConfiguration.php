<?php

namespace App\Modules\Safeguarding;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Safeguarding\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'safeguarding';
}

    public function getButtonTitle()
    {
        return 'Safeguarding';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/safeguarding';
    }

    public function getAdminURL()
    {
        return '/admin/safeguarding';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'reaffiliation_tasks', 'safeguarding_awareness');
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
        return 'This is the safeguarding module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}