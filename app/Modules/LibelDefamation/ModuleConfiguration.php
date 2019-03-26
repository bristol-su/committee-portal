<?php

namespace App\Modules\LibelDefamation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Libel & Defamation';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/libeldefamation';
    }

    public function getAdminURL()
    {
        return '/admin/libeldefamation';
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        return 'incomplete';
    }

    public function getDescription()
    {
        return 'This is the libel & defamation module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }
}