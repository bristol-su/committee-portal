<?php

namespace App\Modules\TierSelection;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\TierSelection\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'tierselection';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Tier Selection';
    }

    public function getHeaderKey()
    {
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/tierselection';
    }

    public function getAdminURL()
    {
        return '/admin/tierselection';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;

        return Submission::countSubmissions(getGroupID()) > 0;
    }

    public function getDescription()
    {
        return 'Tier selection module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }
}