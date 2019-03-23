<?php

namespace App\Modules\GroupInfo;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Group Info';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/groupinfo';
    }

    public function getAdminURL()
    {
        return '/admin/groupinfo';
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        return 'incomplete';
    }

    public function getDescription()
    {
        return 'This is the group info module';
    }

    public function getAdminHeaderKey()
    {
        return 'group-info';
    }
}