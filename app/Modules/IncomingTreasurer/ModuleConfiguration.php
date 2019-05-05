<?php

namespace App\Modules\IncomingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'incomingtreasurer';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Incoming Treasurer Training';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getUserURL()
    {
        return '/incomingtreasurer';
    }

    public function getAdminURL()
    {
        return '/admin/incomingtreasurer';
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
        return 'This is the incoming treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }
}