<?php

namespace App\Modules\Presentation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'presentation';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Presentation';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return false;
    }

    public function getUserURL()
    {
        return '/presentation';
    }

    public function getAdminURL()
    {
        return '/admin/presentation';
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
        return 'This is the presentation module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }
}