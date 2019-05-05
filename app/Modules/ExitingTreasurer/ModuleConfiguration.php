<?php

namespace App\Modules\ExitingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\ExitingTreasurer\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

    public function alias()
    {
        return 'exitingtreasurer';
    }

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Outgoing Treasurer Sign-Off';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return !$this->groupHasTag($group, 'group_type', 'volunteering');
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/exitingtreasurer';
    }

    public function getAdminURL()
    {
        return '/admin/exitingtreasurer';
    }

    public function isComplete(Group $group)
    {
        return Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => $group->id,
            'complete' => true
        ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This is the exiting treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}