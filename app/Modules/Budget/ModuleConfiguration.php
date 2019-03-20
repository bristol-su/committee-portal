<?php

namespace App\Modules\Budget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Budget\Entities\File;

class ModuleConfiguration extends BaseModuleConfiguration
{

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return 'Budget';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-optional';
    }

    public function getUserURL()
    {
        return '/budget';
    }

    public function getAdminURL()
    {
        return '/admin/budget';
    }

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        if (File::where([
                'year' => getReaffiliationYear(),
                'status' => 'approved',
                'group_id' => getGroupID()
            ])->count() === 0) {

            return 'incomplete';
        }
        return 'complete';
    }

    public function getDescription()
    {
        return 'This is the budget module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}