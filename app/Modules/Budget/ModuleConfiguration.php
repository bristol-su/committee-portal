<?php

namespace App\Modules\Budget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return 'Budget';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/budget';
    }

    public function getAdminURL()
    {
        return '/admin/budget';
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
        return 'This is the budget module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}