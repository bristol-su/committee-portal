<?php

namespace App\Modules\EquipmentList;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Equipment List';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/equipmentlist';
    }

    public function getAdminURL()
    {
        return '/admin/equipmentlist';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        return false;
    }

    public function getDescription()
    {
        return 'This is the equipment list module';
    }

    public function getAdminHeaderKey()
    {
        return 'assets';
    }
}