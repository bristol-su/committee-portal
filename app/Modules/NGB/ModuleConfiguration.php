<?php

namespace App\Modules\NGB;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'NGB';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/ngb';
    }

    public function getAdminURL()
    {
        return '/admin/ngb';
    }

    public function isComplete()
    {
        return false;
    }

    public function getDescription()
    {
        return 'This is the ngb module';
    }

    public function getAdminHeaderKey()
    {
        return 'ngb';
    }
}