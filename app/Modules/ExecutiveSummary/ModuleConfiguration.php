<?php

namespace App\Modules\ExecutiveSummary;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Executive Summary';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/executivesummary';
    }

    public function getAdminURL()
    {
        return '/admin/executivesummary';
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
        return 'This is the executive summary module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }
}