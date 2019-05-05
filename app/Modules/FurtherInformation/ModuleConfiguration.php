<?php

namespace App\Modules\FurtherInformation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'furtherinformation';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Further Information';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return false;
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/furtherinformation';
    }

    public function getAdminURL()
    {
        return '/admin/furtherinformation';
    }

    public function isComplete(Group $group)
    {
        return true;
    }

    public function getDescription()
    {
        return 'This is the further information module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }
}