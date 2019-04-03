<?php

namespace App\Modules\Budget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Budget\Entities\File;
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
        if($this->isComplete()) { return 'complete'; }
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

    public function isComplete()
    {
        return File::where([
            'year' => getReaffiliationYear(),
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'status' => 'approved'
        ])->count() > 0;
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