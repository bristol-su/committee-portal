<?php

namespace App\Modules\PresidentHandover;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'President Handover';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/presidenthandover';
    }

    public function getAdminURL()
    {
        return '/admin/presidenthandover';
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }

        return 'incomplete';
    }

    public function getDescription()
    {
        return 'This is the president handover module';
    }

    public function getAdminHeaderKey()
    {
        return 'committee-details';
    }
}