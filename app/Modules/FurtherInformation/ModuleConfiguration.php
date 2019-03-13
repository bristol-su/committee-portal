<?php

namespace App\Modules\FurtherInformation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Further Information';
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


    public function reaffiliationStatus()
    {
        return 'complete';
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