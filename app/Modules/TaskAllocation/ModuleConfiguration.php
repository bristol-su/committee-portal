<?php

namespace App\Modules\TaskAllocation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\TaskAllocation\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'taskallocation';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Reaffiliation Task Allocation';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/taskallocation';
    }

    public function getAdminURL()
    {
        return '/admin/taskallocation';
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
        return 'This is the task allocation module';
    }

    public function getAdminHeaderKey()
    {
        return 'committee-details';
    }

}