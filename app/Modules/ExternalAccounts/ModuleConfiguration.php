<?php

namespace App\Modules\ExternalAccounts;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'External Accounts';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/externalaccounts';
    }

    public function getAdminURL()
    {
        return '/admin/externalaccounts';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        return false;
    }

    public function getDescription()
    {
        return 'This is the external accounts module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}