<?php

namespace App\Modules\IncomingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Incoming Treasurer';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/incomingtreasurer';
    }

    public function getAdminURL()
    {
        return '/incomingtreasurer/admin';
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
        return 'This is the incoming treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }
}