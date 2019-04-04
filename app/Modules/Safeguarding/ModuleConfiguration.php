<?php

namespace App\Modules\Safeguarding;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Safeguarding\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'safeguarding';
}

    public function getButtonTitle()
    {
        return 'Safeguarding';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/safeguarding';
    }

    public function getAdminURL()
    {
        return '/admin/safeguarding';
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
        return 'This is the safeguarding module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}