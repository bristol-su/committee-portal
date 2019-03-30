<?php

namespace App\Modules\Safeguarding;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

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

    public function getVisibility()
    {
        return true;
    }

    public function isActive()
    {
        return true;
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        return 'incomplete';
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