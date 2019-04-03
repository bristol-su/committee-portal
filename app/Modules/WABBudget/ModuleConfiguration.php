<?php

namespace App\Modules\WABBudget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\WABBudget\Entities\File;
use Illuminate\Support\Facades\Auth;

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
        return 'we-are-bristol';
    }

    public function getUserURL()
    {
        return '/wabbudget';
    }

    public function getAdminURL()
    {
        return '/admin/wabbudget';
    }

    public function getVisibility()
    {
        return true;
    }

    public function isActive()
    {
        return true;
    }

    public function isComplete()
    {
        return File::where([
            'year' => getReaffiliationYear(),
            'status' => 'approved',
            'group_id' => getGroupID()
        ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This is the #WeAreBristol budget module';
    }

    public function getAdminHeaderKey()
    {
        return 'we-are-bristol';
    }

}