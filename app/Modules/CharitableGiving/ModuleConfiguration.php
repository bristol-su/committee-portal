<?php

namespace App\Modules\CharitableGiving;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function alias()
    {
        return 'charitablegiving';
    }

    public function getButtonTitle()
    {
        return 'Charitable Giving';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/charitablegiving';
    }

    public function getAdminURL()
    {
        return '/admin/charitablegiving';
    }

    public function isComplete()
    {
        if (!$this->actingAsStudent()) {
            return false;
        };
        return false;
    }

    public function getDescription()
    {
        return 'This page gives you guidance on raising and giving money to charity whilst complying with UK Charity Law.';
    }

    public function getAdminHeaderKey()
    {
        return 'assets';
    }
}