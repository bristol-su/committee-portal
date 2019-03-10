<?php

namespace App\Modules\ExitingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Exiting Treasurer';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/exitingtreasurer';
    }

    public function getAdminURL()
    {
        return '/admin/exitingtreasurer';
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
        return 'This is the exiting treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}