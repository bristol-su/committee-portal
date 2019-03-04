<?php

namespace App\Modules\Constitution;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Constitution';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/constitution';
    }

    public function getAdminURL()
    {
        return '/constitution/admin';
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
        return 'This is the constitution module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }

}