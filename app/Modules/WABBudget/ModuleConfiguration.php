<?php

namespace App\Modules\WABBudget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return '#WeAreBristol Budget';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/wabbudget';
    }

    public function getAdminURL()
    {
        return '/admin/wabbudget';
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
        return 'This is the #WeAreBristol budget module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }

}