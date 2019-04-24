<?php

namespace App\Modules\ExternalAccounts;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'externalaccounts';
}

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
        return 'This page captures details about your external bank account. This is where you will submit details of your externally audited accounts.';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}