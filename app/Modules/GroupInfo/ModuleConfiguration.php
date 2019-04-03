<?php

namespace App\Modules\GroupInfo;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\GroupInfo\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Key Group Info';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/groupinfo';
    }

    public function getAdminURL()
    {
        return '/admin/groupinfo';
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
        return 'This is the group info module';
    }

    public function getAdminHeaderKey()
    {
        return 'group-info';
    }
}