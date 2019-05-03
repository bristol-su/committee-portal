<?php

namespace App\Modules\GDPR;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\GDPR\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'gdpr';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'GDPR';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/gdpr';
    }

    public function getAdminURL()
    {
        return '/admin/gdpr';
    }

    public function isComplete()
    {
        if(!$this->actingAsStudent()) { return false; } ;
        return Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This page helps you understand your responsibilities in complying with Data Protection and GDPR regulations.';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}