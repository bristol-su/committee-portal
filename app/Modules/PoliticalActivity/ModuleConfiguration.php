<?php

namespace App\Modules\PoliticalActivity;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Political Activity';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/politicalactivity';
    }

    public function getAdminURL()
    {
        return '/admin/politicalactivity';
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        return 'incomplete';
    }

    public function getDescription()
    {
        return 'This is the political activity module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }
}