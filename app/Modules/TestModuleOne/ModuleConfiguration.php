<?php

namespace App\Modules\TestModuleOne;

use App\Modules\ModuleConfiguration as BaseModuleConfiguration;
use Illuminate\Support\Collection;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Button Title';
    }

    public function getHeaderKey()
    {
        return 'reaff';
    }

    public function getUserURL()
    {
        return '/portal';
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

}