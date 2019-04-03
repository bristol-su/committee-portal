<?php

namespace App\Modules\TaskAllocation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Task Allocation';
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
        // TODO
        return false;
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