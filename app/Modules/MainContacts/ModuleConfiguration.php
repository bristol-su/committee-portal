<?php

namespace App\Modules\MainContacts;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Notification';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/maincontacts';
    }

    public function getAdminURL()
    {
        return '/admin/maincontacts';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        // TODO
        return false;
    }

    public function getDescription()
    {
        return 'This is the main contacts module';
    }

    public function getAdminHeaderKey()
    {
        return 'committee-details';
    }
}