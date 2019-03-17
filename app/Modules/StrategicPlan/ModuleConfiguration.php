<?php

namespace App\Modules\StrategicPlan;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    public function getButtonTitle()
    {
        return 'Strategic Plan';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/strategicplan';
    }

    public function getAdminURL()
    {
        return '/admin/strategicplan';
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
        return 'This is the strategic plan module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }

}