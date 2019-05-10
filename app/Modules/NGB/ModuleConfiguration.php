<?php

namespace App\Modules\NGB;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\NGB\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'ngb';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'NGB';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/ngb';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'reaffiliation_tasks', 'ngb_safety_statement');
    }

    public function getAdminURL()
    {
        return '/admin/ngb';
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
        return 'This page allows us to understand how you comply with your governing body\'s safety standards.';
    }

    public function getAdminHeaderKey()
    {
        return 'statements';
    }
}