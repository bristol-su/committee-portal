<?php

namespace App\Modules\Budget;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Budget\Entities\File;
use App\Traits\CanSeeGroupTags;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{
    public function alias()
    {
        return 'budget';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'financial_risk', 'high');
    }

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return 'Annual Budget';
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

    public function isComplete(Group $group)
    {
        return File::where([
                'year' => getReaffiliationYear(),
                'group_id' => $group->id,
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

    public function isMandatory()
    {
        // TODO Refactor this ASAP
    }

}
