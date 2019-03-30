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

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
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