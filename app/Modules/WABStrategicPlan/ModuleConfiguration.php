<?php

namespace App\Modules\WABStrategicPlan;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return '#WeAreBristol Strategic Plan';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/wabstrategicplan';
    }

    public function getAdminURL()
    {
        return '/admin/wabstrategicplan';
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
        return 'incomplete';
    }

    public function getDescription()
    {
        return 'This is the #WeAreBristol Strategic Plan module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }

}